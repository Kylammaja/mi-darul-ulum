
<section
    id="kepala-sekolah"
    class="relative overflow-hidden bg-primary py-20 sm:py-24 lg:py-28"
>
    <!-- Background dekoratif -->
    <div class="pointer-events-none absolute -left-40 -top-40 h-[450px] w-[450px] rounded-full bg-secondary/20 blur-3xl"></div>

    <div class="pointer-events-none absolute -bottom-40 right-0 h-[450px] w-[450px] rounded-full bg-secondary/15 blur-3xl"></div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-14 px-6 lg:grid-cols-2 lg:gap-20 lg:px-10">

        <!-- FOTO KIRI -->
        <div class="relative mx-auto flex w-full max-w-[450px] items-center justify-center">

            <!-- Lingkaran utama -->
            <div class="relative flex aspect-square w-[90%] items-center justify-center rounded-full bg-secondary sm:w-full">

                <!-- Lingkaran dekoratif -->
                <div class="absolute inset-5 rounded-full border border-white/20"></div>

                <!-- Foto kepala madrasah -->
                @if (file_exists(public_path('images/kepala-sekolah.png')))

                    <img
                        src="{{ asset('images/kepala-sekolah.png') }}"
                        alt="Kepala Madrasah MI Darul Ullum Gedongan"
                        class="relative z-10 h-full w-full object-contain drop-shadow-2xl"
                    >

                @else

                    <div class="relative z-10 flex flex-col items-center text-center text-white">
                        <span class="text-7xl">👨‍🏫</span>

                        <p class="mt-5 font-heading text-lg font-bold">
                            Foto Kepala Madrasah
                        </p>

                        <p class="mt-2 text-xs text-white/70">
                            PNG transparan
                        </p>
                    </div>

                @endif

            </div>

            <!-- Badge melayang -->
            <div class="absolute -bottom-2 left-0 z-20 rounded-2xl border border-white/20 bg-white px-5 py-4 shadow-xl sm:bottom-5">

                <p class="font-heading text-sm font-bold text-primary">
                    Kepala Madrasah
                </p>

                <p class="mt-1 text-xs text-secondary">
                    MI Darul Ullum Gedongan
                </p>

            </div>

            <!-- Dekorasi lingkaran -->
            <div class="absolute -right-2 top-12 h-14 w-14 rounded-full border-4 border-white/20"></div>

        </div>


        <!-- SAMBUTAN KANAN -->
        <div class="relative text-white">

            <!-- Label -->
            <div class="mb-5 flex items-center gap-3">

                <span class="h-px w-8 bg-white/60"></span>

                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/70">
                    Sambutan Kepala Madrasah
                </p>

            </div>

            <!-- Judul -->
            <h2 class="max-w-xl font-heading text-3xl font-extrabold leading-tight tracking-tight sm:text-4xl lg:text-5xl">

                Mengenal Lebih Dekat

                <span class="text-white/65">
                    MI Darul Ullum Gedongan.
                </span>

            </h2>

            <!-- Paragraf -->
            <p class="mt-7 max-w-xl font-body text-sm leading-8 text-white/75 sm:text-base">

                Assalamu'alaikum Warahmatullahi Wabarakatuh.

                <br><br>

                Selamat datang di website MI Darul Ullum Gedongan.

                Melalui website ini, kami berharap dapat memberikan
                informasi mengenai kegiatan, perkembangan, dan berbagai
                program pendidikan yang ada di madrasah kami.

                <br><br>

                Semoga website ini menjadi sarana komunikasi yang
                bermanfaat bagi siswa, orang tua, dan masyarakat.

            </p>

            <!-- Nilai pendidikan -->
            <div class="mt-9 grid grid-cols-3 gap-4 border-t border-white/15 pt-8">

                <div>
                    <h3 class="font-heading text-sm font-bold text-white sm:text-base">
                        Islami
                    </h3>
                    <p class="mt-2 text-xs text-white/60">
                        Nilai Akhlak
                    </p>
                </div>

                <div>
                    <h3 class="font-heading text-sm font-bold text-white sm:text-base">
                        Kreatif
                    </h3>
                    <p class="mt-2 text-xs text-white/60">
                        Pembelajaran
                    </p>
                </div>

                <div>
                    <h3 class="font-heading text-sm font-bold text-white sm:text-base">
                        Berprestasi
                    </h3>
                    <p class="mt-2 text-xs text-white/60">
                        Pengembangan Diri
                    </p>
                </div>

            </div>

            <!-- Tombol -->
            <div class="mt-10 flex flex-wrap items-center gap-6">

                <a
                    href="#profil"
                    class="group inline-flex items-center gap-4 rounded-full bg-white px-6 py-3 text-sm font-bold text-primary transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                >
                    Profil Madrasah

                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-secondary text-white transition group-hover:rotate-45">
                        ↗
                    </span>

                </a>

                <div>
                    <p class="font-heading text-sm font-bold text-white">
                        Nama Kepala Madrasah
                    </p>

                    <p class="mt-1 text-xs text-white/60">
                        Kepala MI Darul Ullum Gedongan
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>
