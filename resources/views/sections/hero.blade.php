<section
    id="beranda"
    class="relative isolate overflow-hidden bg-white"
>
    <!-- DEKORASI BACKGROUND -->
    <div class="pointer-events-none absolute -right-40 top-10 h-600px w-600px rounded-full bg-secondary/5 blur-3xl"></div>

    <div class="pointer-events-none absolute -left-60 bottom-0 h-500px w-500px rounded-full bg-secondary/5 blur-3xl"></div>

    <!-- CONTAINER -->
    <div class="relative mx-auto grid min-h-[calc(100svh-80px)] max-w-7xl grid-cols-1 items-center gap-16 px-6 py-16 lg:grid-cols-2 lg:gap-20 lg:px-10">

        <!-- TEKS KIRI -->
        <div class="hero-enter">

            <!-- LABEL -->
            <div class="mb-8 inline-flex items-center gap-3 rounded-full border border-secondary/15 bg-secondary/5 px-5 py-2.5">

                <span class="h-2 w-2 rounded-full bg-secondary"></span>

                <span class="text-xs font-bold tracking-wide text-secondary">
                    Selamat Datang di Madrasah Kami
                </span>

            </div>

            <!-- HEADING -->
            <h1 class="max-w-xl font-heading text-[clamp(2.75rem,5vw,4.75rem)] font-extrabold leading-[1.12] tracking-[-0.055em] text-primary">

                Membangun

                <span class="text-secondary">
                    Generasi Hebat,
                </span>

                untuk Masa Depan.

            </h1>

            <!-- DESCRIPTION -->
            <p class="mt-7 max-w-lg font-body text-base leading-8 text-slate-500">

                MI Darul Ullum Gedongan hadir sebagai tempat
                belajar, bertumbuh, dan mengembangkan potensi
                anak melalui pendidikan yang berlandaskan
                nilai-nilai Islam.

            </p>

            <!-- BUTTON -->
            <div class="mt-10 flex flex-wrap items-center gap-5">

                <a
                    href="#profil"
                    class="group inline-flex items-center gap-4 rounded-full bg-primary px-8 py-4 text-sm font-bold text-white shadow-lg shadow-primary/10 transition duration-300 hover:-translate-y-1 hover:bg-secondary"
                >
                    Jelajahi Sekolah

                    <span class="transition group-hover:translate-x-1">
                        ↗
                    </span>
                </a>

                <a
                    href="#visi-misi"
                    class="inline-flex items-center gap-2 text-sm font-bold text-primary transition hover:text-secondary"
                >
                    Visi & Misi
                    <span>→</span>
                </a>

            </div>

            <!-- DETAIL BAWAH -->
            <div class="mt-14 flex items-center gap-4">

                <div class="h-px w-10 bg-secondary"></div>

                <p class="text-xs font-medium tracking-wide text-slate-400">
                    Berilmu • Berakhlak • Berkembang
                </p>

            </div>

        </div>


        <!-- GAMBAR KANAN -->
        <div class="animate-fade-in relative mx-auto w-full max-w-480px">

            <!-- FRAME -->
            <div class="relative aspect-4/5 overflow-hidden rounded-[40px] bg-linear-to-br from-[#E6F4F0] via-[#D5EBE6] to-[#BDE0D9]">

                <!-- DEKORASI -->
                <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full border border-white/70"></div>

                <div class="absolute -bottom-24 -left-20 h-80 w-80 rounded-full bg-secondary/10"></div>

                <!-- FOTO SEKOLAH -->
                @if (file_exists(public_path('images/hero-sekolah.png')))

                    <img
                        src="{{ asset('images/hero-sekolah.png') }}"
                        alt="MI Darul Ullum Gedongan"
                        class="absolute inset-0 h-full w-full object-contain object-bottom drop-shadow-2xl"
                    >

                @else

                    <!-- PLACEHOLDER FOTO -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-8 text-center">

                        <span class="text-7xl">🏫</span>

                        <p class="mt-6 font-heading text-xl font-bold text-primary">
                            MI Darul Ullum Gedongan
                        </p>

                        <p class="mt-3 text-sm leading-6 text-secondary">
                            Foto sekolah akan ditampilkan di sini
                        </p>

                    </div>

                @endif

            </div>

            <!-- KARTU MELAYANG -->
            <div class="absolute -bottom-5 left-3 rounded-2xl border border-white bg-white px-5 py-4 shadow-xl sm:-left-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-secondary/10 text-xl text-secondary">
                        ✦
                    </div>

                    <div>
                        <h3 class="font-heading text-sm font-bold text-primary">
                            Pendidikan Berkualitas
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Tumbuh Bersama, Raih Prestasi
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>