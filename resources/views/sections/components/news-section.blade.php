
@php
    // DATA CONTOH BERITA
    $berita = [
        [
            'kategori' => 'Kegiatan',
            'judul' => 'Aktivitas Pembelajaran Siswa',
            'deskripsi' => 'Suasana pembelajaran dan kegiatan peserta didik di lingkungan madrasah.',
            'gambar' => 'berita-1.jpg',
        ],
        [
            'kategori' => 'Kreativitas',
            'judul' => 'Kegiatan Kreatif Siswa',
            'deskripsi' => 'Mengembangkan minat, bakat, dan kreativitas melalui berbagai kegiatan.',
            'gambar' => 'berita-2.jpg',
        ],
        [
            'kategori' => 'Prestasi',
            'judul' => 'Semangat Meraih Prestasi',
            'deskripsi' => 'Mengapresiasi semangat belajar dan pencapaian peserta didik.',
            'gambar' => 'berita-3.jpg',
        ],
        [
            'kategori' => 'Keagamaan',
            'judul' => 'Pembiasaan Nilai-Nilai Islami',
            'deskripsi' => 'Membentuk karakter melalui pendidikan dan kegiatan keagamaan.',
            'gambar' => 'berita-4.jpg',
        ],
        [
            'kategori' => 'Ekstrakurikuler',
            'judul' => 'Mengembangkan Bakat Siswa',
            'deskripsi' => 'Mendukung minat, bakat, dan potensi peserta didik.',
            'gambar' => 'berita-5.jpg',
        ],
        [
            'kategori' => 'Informasi',
            'judul' => 'Informasi dan Agenda Madrasah',
            'deskripsi' => 'Informasi mengenai agenda dan kegiatan di lingkungan sekolah.',
            'gambar' => 'berita-6.jpg',
        ],
    ];
@endphp

<section
    id="berita-prestasi"
    x-data="{
    selected: null,
    page: 0,
    direction: 1,
    changePage(direction) {
        const next = this.page + direction;
        if (next < 0 || next >= this.totalPages) return;
        this.direction = direction;
        this.page = next;
    },
    totalPages: {{ ceil(count($berita) / 3) }}
}"
    @keydown.escape.window="selected = null"
    class="relative overflow-hidden bg-[#F6F9F8] py-20 lg:py-28"
>

    <!-- BACKGROUND DECORATION -->
    <div class="pointer-events-none absolute inset-0">

        <div class="absolute -left-40 top-0 h-96 w-96 rounded-full bg-[#006B66]/5 blur-3xl"></div>

        <div class="absolute -right-32 bottom-0 h-96 w-96 rounded-full bg-[#003844]/5 blur-3xl"></div>

    </div>

    <div class="relative mx-auto max-w-7xl px-6 lg:px-10">

        <!-- SECTION HEADING -->
        <div class="mb-14 text-center">

            <span class="inline-flex rounded-full bg-[#006B66]/10 px-5 py-2 text-xs font-bold tracking-widest text-[#006B66]">
                KABAR MADRASAH
            </span>

            <h2 class="mt-5 font-heading text-3xl font-extrabold text-[#003844] sm:text-4xl lg:text-5xl">

                Berita &
                <span class="text-[#006B66]">
                    Prestasi
                </span>

            </h2>

            <p class="mx-auto mt-5 max-w-2xl text-base leading-8 text-slate-600">
                Temukan informasi terbaru tentang kegiatan,
                kreativitas, dan perkembangan prestasi
                MI Darul Ulum Gedongan.
            </p>

        </div>

        <!-- NEWS CAROUSEL: DESAIN KARTU ASLI DIPERTAHANKAN -->
        <div class="relative">
            <!-- TOMBOL SEBELUMNYA -->
            <button
                type="button"
                @click="changePage(-1)"
                :disabled="page === 0"
                aria-label="Tampilkan tiga berita sebelumnya"
                class="absolute -left-3 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-[#003844]/10 bg-white text-[#003844] shadow-xl transition duration-300 hover:scale-110 hover:bg-[#006B66] hover:text-white disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:scale-100 disabled:hover:bg-white disabled:hover:text-[#003844] lg:-left-8"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />
                </svg>
            </button>

            <!-- TIGA CARD PER HALAMAN -->
            @foreach (array_chunk($berita, 3) as $pageIndex => $items)
                <div
                    x-cloak
                    x-show="page === {{ $pageIndex }}"
                    class="grid gap-7 md:grid-cols-2 lg:grid-cols-3"
                    role="group"
                    aria-label="Kelompok berita {{ $pageIndex + 1 }}"
                >
                    @foreach ($items as $item)
                        @php $globalIndex = $pageIndex * 3 + $loop->index; @endphp
                        <div
                            class="news-carousel-card min-w-0"
                            :class="direction === 1 ? 'news-from-right' : 'news-from-left'"
                            style="--news-delay: {{ $loop->index * 90 }}ms"
                        >
                @if ($loop->index == 1)

                    <!-- WHITE CARD -->
                    <article
                        class="group flex h-full flex-col overflow-hidden rounded-[28px] border border-slate-100 bg-white p-2 shadow-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                    >

                        <div class="relative h-60 overflow-hidden rounded-[22px] bg-[#DCEAE7]">

                            @if (file_exists(public_path('images/' . $item['gambar'])))

                                <img
                                    src="{{ asset('images/' . $item['gambar']) }}"
                                    alt="{{ $item['judul'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                                >

                            @else

                                <div class="flex h-full items-center justify-center text-sm font-semibold text-[#006B66]">
                                    Foto Berita Sekolah
                                </div>

                            @endif

                            <span class="absolute left-4 top-4 rounded-full bg-white px-4 py-2 text-xs font-bold text-[#003844] shadow-sm">
                                {{ $item['kategori'] }}
                            </span>

                        </div>

                        <div class="flex flex-1 flex-col p-5">

                            <h3 class="font-heading text-xl font-bold text-[#003844]">
                                {{ $item['judul'] }}
                            </h3>

                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                {{ $item['deskripsi'] }}
                            </p>

                            <button
                                type="button"
                                @click="selected = {{ $globalIndex }}"
                                class="mt-7 w-full rounded-full bg-[#003844] px-5 py-3.5 text-sm font-bold text-white transition hover:bg-[#006B66]"
                            >
                                Baca Selengkapnya ↗
                            </button>

                        </div>

                    </article>

                @else

                    <!-- FULL IMAGE CARD -->
                    <article
                        class="group relative h-full min-h-[440px] overflow-hidden rounded-[28px] bg-[#003844] shadow-lg transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl"
                    >

                        @if (file_exists(public_path('images/' . $item['gambar'])))

                            <img
                                src="{{ asset('images/' . $item['gambar']) }}"
                                alt="{{ $item['judul'] }}"
                                loading="lazy"
                                class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            >

                        @else

                            <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#003844] to-[#006B66] text-white/50">
                                Foto Berita Sekolah
                            </div>

                        @endif

                        <!-- DARK GRADIENT -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#003844] via-[#003844]/40 to-transparent"></div>

                        <!-- CATEGORY -->
                        <span class="absolute left-5 top-5 rounded-full bg-white/90 px-4 py-2 text-xs font-bold text-[#003844] backdrop-blur-md">
                            {{ $item['kategori'] }}
                        </span>

                        <!-- BOTTOM CONTENT -->
                        <div class="absolute inset-x-0 bottom-0 p-7 text-white">

                            <h3 class="font-heading text-2xl font-bold leading-snug">
                                {{ $item['judul'] }}
                            </h3>

                            <p class="mt-3 text-sm leading-7 text-white/80">
                                {{ $item['deskripsi'] }}
                            </p>

                            <div class="mt-6 border-t border-white/25 pt-5">

                                <button
                                    type="button"
                                    @click="selected = {{ $globalIndex }}"
                                    class="inline-flex items-center gap-3 text-sm font-bold transition-all hover:gap-5"
                                >
                                    Baca Selengkapnya

                                    <span class="flex h-9 w-9 items-center justify-center rounded-full border border-white/40">
                                        ↗
                                    </span>
                                </button>

                            </div>

                        </div>

                    </article>

                @endif

                        </div>
                    @endforeach
                </div>
            @endforeach

            <!-- TOMBOL BERIKUTNYA -->
            <button
                type="button"
                @click="changePage(1)"
                :disabled="page >= totalPages - 1"
                aria-label="Tampilkan tiga berita berikutnya"
                class="absolute -right-3 top-1/2 z-20 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-[#003844]/10 bg-white text-[#003844] shadow-xl transition duration-300 hover:scale-110 hover:bg-[#006B66] hover:text-white disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:scale-100 disabled:hover:bg-white disabled:hover:text-[#003844] lg:-right-8"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </div>

        <!-- VIEW ALL BUTTON -->
        <div class="mt-12 text-center">

            <a
                href="#berita-prestasi"
                class="inline-flex items-center gap-3 rounded-full border-2 border-[#006B66] px-7 py-3.5 text-sm font-bold text-[#006B66] transition hover:bg-[#006B66] hover:text-white"
            >
                Berita & Prestasi Sekolah
                <span>↗</span>
            </a>

        </div>

    </div>

    <!-- DETAIL MODAL -->
    <div
        x-cloak
        x-show="selected !== null"
        x-transition.opacity
        @click.self="selected = null"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-[#003844]/80 p-5 backdrop-blur-sm"
        role="dialog"
        aria-modal="true"
        aria-label="Detail berita"
    >

        @foreach ($berita as $item)

            <div
                x-show="selected === {{ $loop->index }}"
                class="max-h-[85vh] w-full max-w-xl overflow-y-auto rounded-3xl bg-white p-7 shadow-2xl"
            >

                <div class="flex items-center justify-between gap-4">

                    <span class="rounded-full bg-[#006B66]/10 px-4 py-2 text-xs font-bold text-[#006B66]">
                        {{ $item['kategori'] }}
                    </span>

                    <button
                        type="button"
                        @click="selected = null"
                        aria-label="Tutup"
                        class="rounded-full bg-slate-100 px-4 py-2 text-[#003844]"
                    >
                        ✕
                    </button>

                </div>

                <h3 class="mt-6 font-heading text-2xl font-bold text-[#003844]">
                    {{ $item['judul'] }}
                </h3>

                <p class="mt-5 leading-8 text-slate-600">
                    {{ $item['deskripsi'] }}
                </p>

                <p class="mt-5 text-sm text-slate-400">
                    Ini adalah contoh konten. Detail berita resmi sekolah akan ditambahkan kemudian.
                </p>

            </div>

        @endforeach

    </div>

</section>

<style>
    [x-cloak] { display: none !important; }
    /* Transisi kartu saat berpindah halaman; desain card tetap sama. */
    @keyframes newsFromRight {
        from { opacity: 0; transform: translate3d(26px, 12px, 0) scale(.97); filter: blur(5px); }
        to   { opacity: 1; transform: translate3d(0, 0, 0) scale(1); filter: blur(0); }
    }
    @keyframes newsFromLeft {
        from { opacity: 0; transform: translate3d(-26px, 12px, 0) scale(.97); filter: blur(5px); }
        to   { opacity: 1; transform: translate3d(0, 0, 0) scale(1); filter: blur(0); }
    }
    .news-from-right { animation: newsFromRight 550ms cubic-bezier(.2,.8,.2,1) both; animation-delay: var(--news-delay, 0ms); }
    .news-from-left { animation: newsFromLeft 550ms cubic-bezier(.2,.8,.2,1) both; animation-delay: var(--news-delay, 0ms); }
    @media (prefers-reduced-motion: reduce) {
        .news-from-right, .news-from-left { animation: none; }
    }
</style>
