<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GuruController extends Controller
{
    public function index(): View
    {
        $gurus = Guru::orderBy('urutan')->orderBy('id')->paginate(12);

        return view('admin.guru.index', compact('gurus'));
    }

    public function create(): View
    {
        return view('admin.guru.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'jabatan' => ['required', 'string', 'max:150'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        unset($data['foto']); // Jangan kosongkan foto lama jika admin tidak memilih file.
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        Guru::create($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'jabatan' => ['required', 'string', 'max:150'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        unset($data['foto']); // Jangan kosongkan foto lama jika admin tidak memilih file.
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('foto')) {
            $newPhoto = $request->file('foto')->store('guru', 'public');

            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }

            $data['foto'] = $newPhoto;
        }

        $guru->update($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
