@extends('admin.berita.layout')

@section('title', 'Daftar Berita')

@section('content')
<div class="mb-8 flex flex-wrap items-end justify-between gap-5">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-secondary">Manajemen Konten</p>
        <h1 class="mt-2 font-heading text-3xl font-extrabold">Berita & Prestasi</h1>
        <p class="mt-2 text-sm text-slate-500">Kelola konten sekolah yang akan ditampilkan ke pengunjung.</p>
    </div>
    <a href="{{ route('admin.berita.create') }}"
       class="inline-flex items-center gap-2 rounded-full bg-secondary px-6 py-3 text-sm font-bold text-white shadow-lg shadow-secondary/10 transition hover:bg-primary">
        + Tambah Berita
    </a>
</div>

<div class="mb-8 grid gap-4 sm:grid-cols-3">
    <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Total Berita</p><p class="mt-2 text-3xl font-extrabold">{{ $total }}</p></div>
    <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Dipublikasikan</p><p class="mt-2 text-3xl font-extrabold text-secondary">{{ $published }}</p></div>
    <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-sm text-slate-500">Draft</p><p class="mt-2 text-3xl font-extrabold">{{ $draft }}</p></div>
</div>

<div class="overflow-hidden rounded-2xl border border-primary/10 bg-white shadow-sm">
    <form method="GET" action="{{ route('admin.berita.index') }}" class="flex flex-wrap gap-3 border-b border-slate-100 p-5">
        <label for="q" class="sr-only">Cari berita</label>
        <input id="q" name="q" value="{{ request('q') }}" placeholder="Cari judul atau kategori..."
               class="min-w-0 flex-1 rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-secondary">
        <label for="status" class="sr-only">Status berita</label>
        <select id="status" name="status" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-secondary">
            <option value="">Semua Status</option>
            <option value="published" @selected(request('status') === 'published')>Publikasi</option>
            <option value="draft" @selected(request('status') === 'draft')>Draft</option>
        </select>
        <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-bold text-white hover:bg-secondary">Cari</button>
        <a href="{{ route('admin.berita.index') }}" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium">Reset</a>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[750px] text-left text-sm">
            <thead class="bg-[#F5F9F7] text-xs uppercase tracking-wider text-slate-600">
                <tr><th class="px-5 py-4">Berita</th><th class="px-5 py-4">Kategori</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Dibuat</th><th class="px-5 py-4">Aksi</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($beritas as $berita)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if ($berita->gambar)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($berita->gambar) }}" alt="" loading="lazy" class="h-14 w-16 shrink-0 rounded-lg object-cover">
                                @else
                                    <div class="flex h-14 w-16 shrink-0 items-center justify-center rounded-lg bg-secondary/10 text-xl text-secondary">✦</div>
                                @endif
                                <div><p class="max-w-xs font-bold text-primary">{{ $berita->judul }}</p><p class="mt-1 line-clamp-1 max-w-xs text-xs text-slate-500">{{ $berita->deskripsi }}</p></div>
                            </div>
                        </td>
                        <td class="px-5 py-4">{{ $berita->kategori }}</td>
                        <td class="px-5 py-4">
                            @if ($berita->is_published)
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-800">Publikasi</span>
                            @else
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">Draft</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-500">{{ $berita->created_at?->format('d/m/Y') }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.berita.edit', $berita) }}" class="font-bold text-secondary hover:underline">Edit</a>
                                <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-bold text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-12 text-center text-slate-500">Belum ada berita. Klik “Tambah Berita” untuk membuat berita pertama.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($beritas->hasPages())
        <div class="border-t border-slate-100 px-5 py-4">{{ $beritas->links() }}</div>
    @endif
</div>
@endsection
