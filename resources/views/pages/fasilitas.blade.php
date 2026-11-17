@extends('layouts.inner')

@section('title', 'Fasilitas Sekolah - MI Darul Ulum Gedongan')

@section('content')
@php
    // Letakkan foto di public/images/fasilitas/
    $foto = [
        'kelas' => 'images/fasilitas/ruang-kelas.webp',
        'perpustakaan' => 'images/fasilitas/perpustakaan.webp',
        'lapangan' => 'images/fasilitas/lapangan.webp',
        'mushola' => 'images/fasilitas/mushola.webp',
        'uks' => 'images/fasilitas/uks.webp',
    ];
@endphp

<section id="fasilitas" class="relative overflow-hidden bg-[#F6F9F8] pb-24 pt-32 lg:pb-32 lg:pt-40">
    <!-- Dekorasi halus agar konsisten dengan halaman lain -->
    <div class="pointer-events-none absolute -left-32 top-10 h-80 w-80 rounded-full bg-[#006B66]/5 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-32 bottom-0 h-96 w-96 rounded-full bg-[#003844]/5 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-10">
        <header class="mx-auto mb-12 max-w-3xl text-center">
            <span class="inline-flex rounded-full bg-[#006B66]/10 px-5 py-2 text-xs font-bold uppercase tracking-[.18em] text-[#006B66]">
                Sarana & Prasarana
            </span>
            <h1 class="mt-5 font-heading text-4xl font-extrabold tracking-tight text-[#003844] sm:text-5xl">
                Fasilitas <span class="text-[#006B66]">Sekolah</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-slate-600">
                Mengenal berbagai ruang dan sarana yang mendukung kegiatan belajar,
                pengembangan karakter, dan aktivitas peserta didik.
            </p>
        </header>

        <!-- Bingkai luar putih dan bento grid seperti referensi -->
        <div class="rounded-[32px] border border-[#003844]/5 bg-white p-3 shadow-[0_25px_80px_rgba(0,56,68,0.09)] sm:p-5">
            <div class="grid grid-cols-1 gap-3 md:grid-cols-6 md:gap-4">

                <!-- 1. Ruang Kelas | Atas kiri -->
                <article class="group relative min-h-[330px] overflow-hidden rounded-[22px] bg-[#E8F0EE] md:col-span-2">
                    @if (is_file(public_path($foto['kelas'])))
                        <img src="{{ asset($foto['kelas']) }}" alt="Ruang kelas MI Darul Ulum Gedongan"
                             class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E1ECE8] to-[#B9D6CE] px-6 text-center text-sm font-medium text-[#006B66]">
                            Foto Ruang Kelas
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#003844]/85 via-[#003844]/10 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                        <span class="text-xs font-bold uppercase tracking-[.15em] text-white/80">01 / Ruang Belajar</span>
                        <h2 class="mt-2 font-heading text-2xl font-bold">Ruang Kelas</h2>
                        <p class="mt-2 max-w-xs text-sm leading-6 text-white/85">Ruang untuk kegiatan pembelajaran sehari-hari.</p>
                    </div>
                </article>

                <!-- 2. Panel utama | Atas tengah -->
                <article class="relative flex min-h-[330px] flex-col justify-between overflow-hidden rounded-[22px] bg-[#006B66] p-7 text-white md:col-span-2">
                    <div class="pointer-events-none absolute -right-20 -top-16 h-56 w-56 rounded-full border-[35px] border-white/10"></div>
                    <div class="pointer-events-none absolute -bottom-28 -left-12 h-56 w-56 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="relative">
                        <span class="inline-flex rounded-full border border-white/25 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-wider">
                            Lingkungan Belajar
                        </span>
                        <h2 class="mt-7 font-heading text-3xl font-extrabold leading-[1.15] tracking-tight sm:text-4xl">
                            Ruang Nyaman,<br>Belajar Menyenangkan.
                        </h2>
                    </div>
                    <div class="relative flex items-end justify-between gap-4">
                        <p class="max-w-[230px] text-sm leading-6 text-white/85">
                            Mengenal fasilitas madrasah melalui tampilan yang lebih dekat dan interaktif.
                        </p>
                        <span aria-hidden="true" class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-white/40 text-xl">↗</span>
                    </div>
                </article>

                <!-- 3. Perpustakaan | Atas kanan -->
                <article class="group relative flex min-h-[330px] flex-col overflow-hidden rounded-[22px] bg-[#F4F7F6] md:col-span-2">
                    <div class="relative z-10 px-6 pt-6">
                        <span class="text-xs font-bold uppercase tracking-[.15em] text-[#006B66]">02 / Literasi</span>
                        <h2 class="mt-2 font-heading text-2xl font-bold text-[#003844]">Perpustakaan</h2>
                        <p class="mt-2 max-w-xs text-sm leading-6 text-slate-600">Ruang untuk membaca dan memperluas wawasan.</p>
                    </div>
                    <div class="relative mt-5 min-h-[165px] flex-1 overflow-hidden">
                        @if (is_file(public_path($foto['perpustakaan'])))
                            <img src="{{ asset($foto['perpustakaan']) }}" alt="Perpustakaan MI Darul Ulum Gedongan"
                                 class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center bg-[#D9E8E3] text-sm font-medium text-[#006B66]">
                                Foto Perpustakaan
                            </div>
                        @endif
                    </div>
                </article>

                <!-- 4. Lapangan | Bawah kiri, melebar -->
                <article class="group relative min-h-[300px] overflow-hidden rounded-[22px] bg-[#003844] md:col-span-3">
                    @if (is_file(public_path($foto['lapangan'])))
                        <img src="{{ asset($foto['lapangan']) }}" alt="Lapangan dan area kegiatan sekolah"
                             class="absolute inset-0 h-full w-full object-cover transition-all duration-700 group-hover:scale-105" loading="lazy">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#284F55] to-[#003844] text-sm font-medium text-white/70">
                            Foto Lapangan Sekolah
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-[#001F28]/90 via-[#003844]/45 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-7 text-white sm:p-8">
                        <span class="text-xs font-bold uppercase tracking-[.15em] text-white/75">03 / Aktivitas Siswa</span>
                        <h2 class="mt-3 max-w-sm font-heading text-3xl font-bold leading-tight">Lapangan &amp;<br>Area Kegiatan</h2>
                        <p class="mt-3 max-w-xs text-sm leading-6 text-white/80">Ruang untuk kegiatan bersama, olahraga, dan aktivitas siswa.</p>
                    </div>
                </article>

                <!-- 5. Fasilitas penunjang | Bawah kanan -->
                <article class="relative flex min-h-[340px] flex-col overflow-hidden rounded-[22px] bg-[#EAF2EF] md:col-span-3 sm:flex-row">
                    <div class="relative z-10 flex w-full flex-col justify-between p-7 sm:w-[48%] sm:pr-0 sm:py-8">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-[.15em] text-[#006B66]">04 / Pendukung</span>
                            <h2 class="mt-4 font-heading text-2xl font-bold leading-tight text-[#003844]">Fasilitas<br>Penunjang</h2>
                            <p class="mt-3 max-w-[220px] text-sm leading-6 text-slate-600">
                                Sarana yang menunjang kenyamanan warga madrasah.
                            </p>
                        </div>
                        <div class="mt-5 flex flex-wrap gap-2">
                            <span class="rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-[#003844] shadow-sm">Mushola</span>
                            <span class="rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-[#003844] shadow-sm">UKS</span>
                        </div>
                    </div>

                    <div class="relative h-52 flex-1 sm:h-auto" aria-label="Kolase foto fasilitas penunjang">
                        <div class="absolute right-[21%] top-[4%] h-[72%] w-[65%] -rotate-6 overflow-hidden rounded-2xl border-[5px] border-white bg-[#BED6CF] shadow-xl transition-transform duration-500 hover:rotate-0">
                            @if (is_file(public_path($foto['mushola'])))
                                <img src="{{ asset($foto['mushola']) }}" alt="Mushola sekolah" class="h-full w-full object-cover" loading="lazy">
                            @else
                                <div class="flex h-full items-center justify-center text-xs font-medium text-[#006B66]">Foto Mushola</div>
                            @endif
                        </div>
                        <div class="absolute bottom-[4%] right-[4%] h-[66%] w-[59%] rotate-6 overflow-hidden rounded-2xl border-[5px] border-white bg-[#CFDFD9] shadow-xl transition-transform duration-500 hover:rotate-0">
                            @if (is_file(public_path($foto['uks'])))
                                <img src="{{ asset($foto['uks']) }}" alt="Ruang UKS sekolah" class="h-full w-full object-cover" loading="lazy">
                            @else
                                <div class="flex h-full items-center justify-center text-xs font-medium text-[#006B66]">Foto UKS</div>
                            @endif
                        </div>
                    </div>
                </article>

            </div>
        </div>
        <p class="mt-5 text-center text-xs text-slate-500">Galeri fasilitas dapat diperbarui sesuai dokumentasi asli madrasah.</p>
    </div>
</section>
@endsection
