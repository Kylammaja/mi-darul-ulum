@extends('admin.guru.layout')

@section('title', 'Kelola Guru')

@section('content')
<div class="mb-8 flex flex-wrap items-end justify-between gap-4">
    <div>
        <span class="inline-flex rounded-full bg-[#006B66]/10 px-4 py-2 text-xs font-bold tracking-widest text-[#006B66]">DATA PENDIDIK</span>
        <h2 class="mt-4 font-heading text-3xl font-extrabold">Manajemen Guru & Staf</h2>
        <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-600">Tambahkan nama, jabatan, foto, dan urutan tampil. Hanya data berstatus aktif yang muncul di website.</p>
    </div>
    <a href="{{ route('admin.struktur-organisasi.create') }}" class="inline-flex items-center justify-center rounded-full bg-[#006B66] px-6 py-3 text-sm font-bold text-white transition hover:bg-[#003844]">+ Tambah Guru</a>
</div>

<div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[750px] text-left text-sm">
            <thead class="bg-[#F2F8F5] text-xs uppercase tracking-wider text-[#003844]">
                <tr>
                    <th scope="col" class="p-5">Foto</th>
                    <th scope="col" class="p-5">Nama Guru</th>
                    <th scope="col" class="p-5">Jabatan</th>
                    <th scope="col" class="p-5">Urutan</th>
                    <th scope="col" class="p-5">Status</th>
                    <th scope="col" class="p-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($gurus as $guru)
                    <tr class="hover:bg-slate-50/70">
                        <td class="p-5">
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto {{ $guru->nama }}" class="h-16 w-14 rounded-xl bg-slate-100 object-contain">
                            @else
                                <div class="flex h-16 w-14 items-center justify-center rounded-xl bg-[#006B66]/10 text-lg font-extrabold text-[#006B66]">{{ mb_substr($guru->nama, 0, 1) }}</div>
                            @endif
                        </td>
                        <td class="p-5 font-bold">{{ $guru->nama }}</td>
                        <td class="p-5 text-slate-600">{{ $guru->jabatan }}</td>
                        <td class="p-5">{{ $guru->urutan }}</td>
                        <td class="p-5">
                            <span class="rounded-full px-3 py-1.5 text-xs font-bold {{ $guru->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $guru->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="p-5">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.struktur-organisasi.edit', $guru) }}" class="rounded-full border border-[#006B66]/20 px-4 py-2 text-xs font-bold text-[#006B66] hover:bg-[#006B66]/5">Edit</a>
                                <form action="{{ route('admin.struktur-organisasi.destroy', $guru) }}" method="POST" onsubmit="return confirm('Hapus data guru ini? Foto terkait juga akan dihapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-full border border-red-200 px-4 py-2 text-xs font-bold text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-16 text-center text-slate-500">Belum ada data guru. Klik <strong>Tambah Guru</strong> untuk mengisi struktur organisasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if ($gurus->hasPages())
    <div class="mt-6">{{ $gurus->links() }}</div>
@endif
@endsection
