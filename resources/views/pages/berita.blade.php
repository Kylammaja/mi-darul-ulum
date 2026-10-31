@extends('layouts.inner')

@section('title', 'Berita & Prestasi | MI Darul Ulum Gedongan')

@section('content')
@php
    /*
     | DATA CONTOH UNTUK DESAIN.
     | Ganti judul, deskripsi, dan gambar dengan berita resmi sekolah.
     | Semua rasio dijaga oleh CSS aspect-ratio, bukan dipaksa ke ukuran seragam.
     */
    $berita = [
        [
            'kategori' => 'Kegiatan',
            'judul' => 'Aktivitas Pembelajaran di Madrasah',
            'deskripsi' => 'Contoh konten mengenai kegiatan belajar dan suasana pembelajaran di lingkungan madrasah.',
            'gambar' => 'images/berita/berita-01.jpg',
            'rasio' => '16 / 9',
            'label_rasio' => '16:9',
        ],
        [
            'kategori' => 'Prestasi',
            'judul' => 'Semangat Meraih Prestasi',
            'deskripsi' => 'Contoh konten untuk menampilkan penghargaan serta pencapaian peserta didik.',
            'gambar' => 'images/berita/berita-02.jpg',
            'rasio' => '3 / 4',
            'label_rasio' => '3:4',
        ],
        [
            'kategori' => 'Keagamaan',
            'judul' => 'Pembiasaan Nilai-Nilai Islami',
            'deskripsi' => 'Contoh konten tentang pembiasaan dan kegiatan keagamaan peserta didik.',
            'gambar' => 'images/berita/berita-03.jpg',
            'rasio' => '9 / 16',
            'label_rasio' => '9:16',
        ],
        [
            'kategori' => 'Literasi',
            'judul' => 'Menumbuhkan Minat Baca Sejak Dini',
            'deskripsi' => 'Contoh konten aktivitas literasi untuk mendukung pembelajaran.',
            'gambar' => 'images/berita/berita-04.jpg',
            'rasio' => '1 / 1',
            'label_rasio' => '1:1',
        ],
        [
            'kategori' => 'Kreativitas',
            'judul' => 'Mengembangkan Kreativitas Siswa',
            'deskripsi' => 'Contoh konten tentang karya, seni, dan aktivitas kreatif peserta didik.',
            'gambar' => 'images/berita/berita-05.jpg',
            'rasio' => '3 / 4',
            'label_rasio' => '3:4',
        ],
        [
            'kategori' => 'Kegiatan',
            'judul' => 'Kebersamaan Warga Madrasah',
            'deskripsi' => 'Contoh konten kegiatan bersama guru, siswa, dan warga madrasah.',
            'gambar' => 'images/berita/berita-06.jpg',
            'rasio' => '3 / 4',
            'label_rasio' => '3:4',
        ],
        [
            'kategori' => 'Ekstrakurikuler',
            'judul' => 'Bakat dan Minat Peserta Didik',
            'deskripsi' => 'Contoh konten kegiatan ekstrakurikuler untuk mengembangkan potensi siswa.',
            'gambar' => 'images/berita/berita-07.jpg',
            'rasio' => '3 / 4',
            'label_rasio' => '3:4',
        ],
        [
            'kategori' => 'Informasi',
            'judul' => 'Agenda dan Informasi Sekolah',
            'deskripsi' => 'Contoh konten pengumuman agenda dan informasi penting madrasah.',
            'gambar' => 'images/berita/berita-08.jpg',
            'rasio' => '1 / 1',
            'label_rasio' => '1:1',
        ],
        [
            'kategori' => 'Dokumentasi',
            'judul' => 'Potret Kegiatan dan Lingkungan Sekolah',
            'deskripsi' => 'Contoh dokumentasi aktivitas dan lingkungan MI Darul Ulum Gedongan.',
            'gambar' => 'images/berita/berita-09.jpg',
            'rasio' => '16 / 9',
            'label_rasio' => '16:9',
        ],
    ];
@endphp

<style>
    /* Hanya berlaku pada halaman Berita. Tidak mengubah carousel di Beranda. */
    .berita-editorial .berita-tile-inner { isolation: isolate; }
    .berita-editorial .berita-tile-inner::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(180deg, rgba(0,56,68,.03) 10%, rgba(0,56,68,.20) 40%, rgba(0,35,42,.88) 100%);
        z-index: 1;
    }
    .berita-editorial .berita-tile-inner:focus-visible {
        outline: 3px solid #006B66;
        outline-offset: 4px;
    }
    .berita-editorial.berita-reveal-ready [data-berita-reveal] {
        opacity: 0;
        transform: translateY(25px) scale(.985);
        filter: blur(4px);
        transition: opacity .8s cubic-bezier(.22,1,.36,1),
                    transform .8s cubic-bezier(.22,1,.36,1),
                    filter .8s cubic-bezier(.22,1,.36,1);
    }
    .berita-editorial.berita-reveal-ready [data-berita-reveal].is-visible {
        opacity: 1;
        transform: none;
        filter: none;
    }
    @media (prefers-reduced-motion: reduce) {
        .berita-editorial [data-berita-reveal] {
            opacity: 1 !important;
            transform: none !important;
            filter: none !important;
            transition: none !important;
        }
        .berita-editorial .berita-tile-inner img { transition: none !important; }
    }
</style>

<section
    id="galeri-berita"
    x-data="{
        selected: null,
        init() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
                !('IntersectionObserver' in window)) return;

            const cards = this.$el.querySelectorAll('[data-berita-reveal]');
            const observer = new IntersectionObserver((entries, currentObserver) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('is-visible');
                    currentObserver.unobserve(entry.target);
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -25px 0px' });

            cards.forEach((card) => observer.observe(card));
            this.$el.classList.add('berita-reveal-ready');
        }
    }"
    @keydown.escape.window="selected = null"
    class="berita-editorial relative overflow-hidden bg-[#F8FBFA] pb-24 pt-16 text-primary sm:pt-20 lg:pb-32"
>
    <!-- Dekorasi latar sangat halus -->
    <div aria-hidden="true" class="pointer-events-none absolute -left-36 top-12 h-96 w-96 rounded-full bg-secondary/5 blur-3xl"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -right-32 top-[40%] h-96 w-96 rounded-full bg-primary/5 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-5 sm:px-6 lg:px-10">
        <!-- HEADER -->
        <div class="mx-auto mb-12 max-w-3xl text-center sm:mb-16" data-berita-reveal>
            <span class="inline-flex items-center gap-2 rounded-full border border-secondary/15 bg-secondary/10 px-4 py-2 text-xs font-bold uppercase tracking-[.17em] text-secondary">
                <span class="h-2 w-2 rounded-full bg-secondary"></span>
                Kabar Madrasah
            </span>
            <h1 class="mt-6 font-heading text-4xl font-extrabold tracking-tight text-primary sm:text-5xl lg:text-6xl">
                Berita &amp; <span class="text-secondary">Inspirasi</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base">
                Cerita kegiatan, kreativitas, dan pencapaian di lingkungan
                MI Darul Ulum Gedongan.
            </p>
        </div>

        <!-- BARIS FEATURED: 16:9 + 3:4 -->
        <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-12 lg:gap-6">
            @foreach (array_slice($berita, 0, 2) as $index => $item)
                <div class="min-w-0 {{ $index === 0 ? 'lg:col-span-8' : 'lg:col-span-4' }}" data-berita-reveal>
                    <button
                        type="button"
                        @click="selected = {{ $index }}"
                        aria-label="Buka detail: {{ $item['judul'] }}"
                        class="berita-tile-inner group relative block w-full overflow-hidden rounded-[24px] bg-primary text-left text-white shadow-lg shadow-primary/10 transition-shadow duration-500 hover:shadow-2xl hover:shadow-primary/20 sm:rounded-[30px]"
                        style="aspect-ratio: {{ $item['rasio'] }};"
                    >
                        @if (file_exists(public_path($item['gambar'])))
                            <img
                                src="{{ asset($item['gambar']) }}"
                                alt="Dokumentasi {{ $item['judul'] }}"
                                class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                                {{ $index === 0 ? 'fetchpriority=high' : 'loading=lazy' }}
                            >
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-[#006B66] via-[#185C5D] to-[#003844]"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-white/20" aria-hidden="true">
                                <svg class="h-24 w-24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <circle cx="8.5" cy="9" r="1.5"/>
                                    <path d="m3 17 5-5 4 4 3-3 6 5"/>
                                </svg>
                            </div>
                        @endif

                        <span class="absolute left-5 top-5 z-10 rounded-full border border-white/30 bg-white/90 px-3.5 py-2 text-[11px] font-bold text-primary backdrop-blur-md">
                            {{ $item['kategori'] }}
                        </span>

                        <div class="absolute inset-x-0 bottom-0 z-10 p-5 sm:p-7">
                            <p class="mb-2 text-xs font-medium text-white/75">Kabar Madrasah <span class="mx-1">·</span> {{ $item['label_rasio'] }}</p>
                            <h2 class="max-w-xl font-heading text-xl font-bold leading-snug sm:text-2xl lg:text-[1.7rem]">
                                {{ $item['judul'] }}
                            </h2>
                            <span class="mt-4 inline-flex items-center gap-2 text-xs font-semibold text-white/85 transition-all group-hover:gap-3">
                                Baca cerita <span aria-hidden="true">↗</span>
                            </span>
                        </div>
                    </button>
                </div>
            @endforeach
        </div>

        <!-- GALERI MASONRY: tinggi kartu mengikuti rasio foto secara tepat -->
        <div class="mt-5 columns-1 gap-5 sm:columns-2 lg:mt-6 lg:columns-3 lg:gap-6">
            @foreach (array_slice($berita, 2) as $index => $item)
                <div class="mb-5 break-inside-avoid lg:mb-6" data-berita-reveal>
                    <button
                        type="button"
                        @click="selected = {{ $index + 2 }}"
                        aria-label="Buka detail: {{ $item['judul'] }}"
                        class="berita-tile-inner group relative block w-full overflow-hidden rounded-[24px] bg-primary text-left text-white shadow-lg shadow-primary/10 transition-shadow duration-500 hover:shadow-2xl hover:shadow-primary/20 sm:rounded-[30px]"
                        style="aspect-ratio: {{ $item['rasio'] }};"
                    >
                        @if (file_exists(public_path($item['gambar'])))
                            <img
                                src="{{ asset($item['gambar']) }}"
                                alt="Dokumentasi {{ $item['judul'] }}"
                                loading="lazy"
                                class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                            >
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-[#006B66] via-[#185C5D] to-[#003844]"></div>
                            <div class="absolute inset-0 flex items-center justify-center text-white/20" aria-hidden="true">
                                <svg class="h-24 w-24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <circle cx="8.5" cy="9" r="1.5"/>
                                    <path d="m3 17 5-5 4 4 3-3 6 5"/>
                                </svg>
                            </div>
                        @endif

                        <span class="absolute left-5 top-5 z-10 rounded-full border border-white/30 bg-white/90 px-3.5 py-2 text-[11px] font-bold text-primary backdrop-blur-md">
                            {{ $item['kategori'] }}
                        </span>

                        <div class="absolute inset-x-0 bottom-0 z-10 p-5 sm:p-6">
                            <p class="mb-2 text-xs font-medium text-white/75">Kabar Madrasah <span class="mx-1">·</span> {{ $item['label_rasio'] }}</p>
                            <h2 class="font-heading text-lg font-bold leading-snug sm:text-xl">
                                {{ $item['judul'] }}
                            </h2>
                            <span class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-white/85 transition-all group-hover:gap-3">
                                Baca cerita <span aria-hidden="true">↗</span>
                            </span>
                        </div>
                    </button>
                </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <p class="text-xs leading-6 text-slate-500">
                Konten dan judul pada halaman ini masih contoh desain. Informasi resmi akan ditambahkan kemudian.
            </p>
        </div>
    </div>

    <!-- DETAIL PREVIEW: tidak memakai route palsu -->
    <div
        x-cloak
        x-show="selected !== null"
        x-transition.opacity
        @click.self="selected = null"
        role="dialog"
        aria-modal="true"
        aria-label="Pratinjau berita sekolah"
        class="fixed inset-0 z-[150] flex items-center justify-center bg-[#003844]/80 p-4 backdrop-blur-md"
    >
        @foreach ($berita as $index => $item)
            <div
                x-cloak
                x-show="selected === {{ $index }}"
                class="max-h-[88vh] w-full max-w-xl overflow-y-auto rounded-[28px] bg-white p-6 text-primary shadow-2xl sm:p-8"
            >
                <div class="flex items-start justify-between gap-5">
                    <span class="rounded-full bg-secondary/10 px-4 py-2 text-xs font-bold text-secondary">{{ $item['kategori'] }}</span>
                    <button type="button" @click="selected = null" aria-label="Tutup detail berita" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xl text-primary transition hover:bg-secondary/10">&times;</button>
                </div>
                <h2 class="mt-6 font-heading text-2xl font-extrabold leading-snug sm:text-3xl">{{ $item['judul'] }}</h2>
                <p class="mt-5 leading-8 text-slate-600">{{ $item['deskripsi'] }}</p>
                <p class="mt-6 border-t border-primary/10 pt-5 text-sm text-slate-500">Ini adalah pratinjau konten. Artikel lengkap akan tersedia setelah data berita resmi ditambahkan melalui admin.</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
