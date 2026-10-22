@php
    // Ganti nilai null setelah data kontak resmi sekolah tersedia.
    $schoolAddress = null;
    $schoolPhone = null; // Contoh format saat diisi: '0311234567'
    $schoolInstagram = null; // Contoh format saat diisi: 'akun_sekolah' (tanpa @)

    $phoneLink = $schoolPhone ? 'tel:' . preg_replace('/[^\d+]/', '', $schoolPhone) : null;
    $instagramLink = $schoolInstagram
        ? 'https://www.instagram.com/' . ltrim($schoolInstagram, '@') . '/'
        : null;
@endphp

<footer id="footer" class="relative isolate overflow-hidden bg-[#003844] text-white">
    <!-- Ornamen lembut agar footer tidak polos -->
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute -right-28 -top-40 h-96 w-96 rounded-full border-[65px] border-white/[0.035]"></div>
        <div class="absolute -left-40 bottom-0 h-80 w-80 rounded-full bg-[#006B66]/25 blur-3xl"></div>
        <div class="absolute right-1/4 bottom-0 h-48 w-48 rounded-full bg-[#006B66]/10 blur-3xl"></div>
    </div>

    <!-- Garis aksen atas -->
    <div class="h-1 w-full bg-gradient-to-r from-[#003844] via-[#49BBAA] to-[#003844]"></div>

    <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 lg:px-10 lg:pt-20">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-12 lg:gap-10">
            <!-- Identitas sekolah -->
            <div class="sm:col-span-2 lg:col-span-5 lg:pr-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3" aria-label="Kembali ke Beranda MI Darul Ulum Gedongan">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-white/15 bg-white p-2 shadow-xl shadow-black/10">
                        @if (file_exists(public_path('images/logo-sekolah.png')))
                            <img src="{{ asset('images/logo-sekolah.png') }}"
                                 alt="Logo MI Darul Ulum Gedongan"
                                 class="h-full w-full object-contain" loading="lazy">
                        @else
                            <span class="font-heading text-sm font-extrabold text-[#003844]">MI</span>
                        @endif
                    </div>
                    <div class="leading-tight">
                        <p class="font-heading text-lg font-extrabold tracking-tight sm:text-xl">MI DARUL ULUM</p>
                        <p class="mt-1 text-xs font-bold tracking-[0.23em] text-[#8BDBCD]">GEDONGAN</p>
                    </div>
                </a>

                <p class="mt-6 max-w-md text-sm leading-8 text-slate-200/85">
                    Website informasi MI Darul Ulum Gedongan. Temukan kabar madrasah,
                    kegiatan siswa, prestasi, serta informasi sekolah dalam satu tempat.
                </p>

                <div class="mt-7 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs font-semibold text-[#BCE6DD]">
                    <span class="h-2 w-2 rounded-full bg-[#70D7B7]"></span>
                    Informasi &amp; kegiatan madrasah
                </div>
            </div>

            <!-- Menu cepat -->
            <div class="lg:col-span-2">
                <h2 class="font-heading text-base font-bold">Jelajahi</h2>
                <div class="mt-3 h-1 w-9 rounded-full bg-[#49BBAA]"></div>
                <ul class="mt-6 space-y-4 text-sm text-slate-200/85">
                    <li><a href="{{ route('home') }}" class="transition hover:pl-1 hover:text-[#8BDBCD]">Beranda</a></li>
                    <li><a href="{{ route('home') }}#visi-misi" class="transition hover:pl-1 hover:text-[#8BDBCD]">Visi &amp; Misi</a></li>
                    <li><a href="{{ route('home') }}#sambutan" class="transition hover:pl-1 hover:text-[#8BDBCD]">Sambutan Kepala Sekolah</a></li>
                    <li><a href="{{ route('home') }}#berita-prestasi" class="transition hover:pl-1 hover:text-[#8BDBCD]">Berita &amp; Prestasi</a></li>
                </ul>
            </div>

            <!-- Informasi yang akan dibuat nanti -->
            <div class="lg:col-span-2">
                <h2 class="font-heading text-base font-bold">Informasi</h2>
                <div class="mt-3 h-1 w-9 rounded-full bg-[#49BBAA]"></div>
                <ul class="mt-6 space-y-4 text-sm text-slate-200/85">
                    <li><span>SPMB <span class="text-xs text-[#8BDBCD]">(segera hadir)</span></span></li>
                    <li><span>Fasilitas <span class="text-xs text-[#8BDBCD]">(segera hadir)</span></span></li>
                    <li><span>Struktur Organisasi <span class="text-xs text-[#8BDBCD]">(segera hadir)</span></span></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="lg:col-span-3">
                <h2 class="font-heading text-base font-bold">Hubungi Kami</h2>
                <div class="mt-3 h-1 w-9 rounded-full bg-[#49BBAA]"></div>
                <ul class="mt-6 space-y-5 text-sm text-slate-200/85">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#8BDBCD]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        <div><p class="font-semibold text-white">Alamat</p><p class="mt-1 leading-6">{{ $schoolAddress ?: 'Alamat resmi sekolah belum ditambahkan.' }}</p></div>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#8BDBCD]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72l.55 2.81a2 2 0 0 1-.57 1.9L7.48 10a16 16 0 0 0 6.52 6.52l1.57-1.61a2 2 0 0 1 1.9-.57l2.81.55A2 2 0 0 1 22 16.92Z"/></svg>
                        <div>
                            <p class="font-semibold text-white">Telepon</p>
                            @if ($phoneLink)
                                <a href="{{ $phoneLink }}" class="mt-1 inline-block transition hover:text-[#8BDBCD]">{{ $schoolPhone }}</a>
                            @else
                                <p class="mt-1">Nomor telepon belum ditambahkan.</p>
                            @endif
                        </div>