<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BeritaController extends Controller
{
    private const KATEGORI = [
        'Kegiatan', 'Kreativitas', 'Prestasi',
        'Keagamaan', 'Ekstrakurikuler', 'Informasi',
    ];

    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('q')) {
            $kata = trim((string) $request->query('q'));
            $query->where(function ($q) use ($kata) {
                $q->where('judul', 'like', "%{$kata}%")
                  ->orWhere('kategori', 'like', "%{$kata}%");
            });
        }

        if ($request->query('status') === 'published') {
            $query->where('is_published', true);
        } elseif ($request->query('status') === 'draft') {
            $query->where('is_published', false);
        }

        return view('admin.berita.index', [
            'beritas' => $query->latest()->paginate(10)->appends(request()->query()),
            'total' => Berita::count(),
            'published' => Berita::where('is_published', true)->count(),
            'draft' => Berita::where('is_published', false)->count(),
        ]);
    }

    public function create()
    {
        return view('admin.berita.create', [
            'kategori' => self::KATEGORI,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->uniqueSlug($data['judul']);
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', [
            'berita' => $berita,
            'kategori' => self::KATEGORI,
        ]);
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $this->validated($request);
        $gambarLama = $berita->gambar;

        // Jika tidak mengunggah foto baru, pertahankan rasio foto sebelumnya.
        if (! $request->hasFile('gambar')) {
            $data['rasio'] = $berita->rasio ?: '16:9';
        }

        if ($data['judul'] !== $berita->judul) {
            $data['slug'] = $this->uniqueSlug($data['judul'], $berita->id);
        }

        $data['published_at'] = $data['is_published']
            ? ($berita->published_at ?? now())
            : null;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        if ($request->hasFile('gambar') && $gambarLama) {
            Storage::disk('public')->delete($gambarLama);
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $gambar = $berita->gambar;
        $berita->delete();

        if ($gambar) {
            Storage::disk('public')->delete($gambar);
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(self::KATEGORI)],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'konten' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'rasio' => ['required', Rule::in(['16:9', '3:4', '9:16', '1:1'])],
            'is_published' => ['required', 'boolean'],
        ], [
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            'gambar.mimes' => 'Gunakan JPG, PNG, atau WebP.',
        ]);

        // Validasi server: hasil crop mesti benar-benar sesuai pilihan rasio.
        // Validasi di browser saja tidak cukup untuk data yang dikirim ke server.
        if ($request->hasFile('gambar')) {
            $dimensions = @getimagesize($request->file('gambar')->getRealPath());
            $width = $dimensions[0] ?? 0;
            $height = $dimensions[1] ?? 0;

            $ratios = [
                '16:9' => 16 / 9,
                '3:4' => 3 / 4,
                '9:16' => 9 / 16,
                '1:1' => 1.0,
            ];
            $expected = $ratios[$data['rasio']];

            if ($height === 0 || abs(($width / $height) - $expected) > 0.02) {
                throw ValidationException::withMessages([
                    'gambar' => 'Foto belum di-crop sesuai rasio yang dipilih. Buka editor crop lalu klik Gunakan Foto.',
                ]);
            }
        }

        return $data;
    }

    private function uniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul) ?: 'berita';
        $slug = $base;
        $number = 2;

        while (Berita::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base . '-' . $number;
            $number++;
        }

        return $slug;
    }
}
