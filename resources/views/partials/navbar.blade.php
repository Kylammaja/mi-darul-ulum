
<header
    x-data="{
        mobileOpen: false,
        infoOpen: false,
        profileOpen: false
    }"
    x-on:keydown.escape.window="
        mobileOpen = false;
        infoOpen = false;
        profileOpen = false
    "
    class="sticky top-0 z-50 border-b border-primary/5 bg-white/95 backdrop-blur-xl"
>
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-10">

        <!-- LOGO -->
        <a href="#beranda" class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary text-lg font-bold text-white">
                MI
            </div>

            <div class="font-heading leading-tight">
                <h2 class="text-sm font-extrabold tracking-tight text-primary">
                    DARUL ULLUM
                </h2>

                <p class="mt-1 text-[10px] font-semibold tracking-[0.15em] text-secondary">
                    GEDONGAN
                </p>
            </div>

        </a>

        <!-- MENU DESKTOP -->
        <nav class="hidden items-center gap-8 lg:flex">

            <a href="#beranda"
               class="text-sm font-semibold text-secondary">
                Beranda
            </a>

            <!-- DROPDOWN INFORMASI -->
            <div class="relative" x-on:click.outside="infoOpen = false">

                <button
                    type="button"
                    x-on:click="infoOpen = !infoOpen; profileOpen = false"
                    x-bind:aria-expanded="infoOpen.toString()"
                    class="flex items-center gap-2 text-sm font-medium text-primary transition hover:text-secondary"
                >
                    Informasi
                    <span>⌄</span>
                </button>

                <div
                    x-show="infoOpen"
                    x-cloak
                    x-transition
                    class="absolute left-0 top-10 w-48 rounded-2xl border border-gray-100 bg-white p-2 shadow-xl"
                >
                    <a href="#spmb" class="block rounded-xl px-4 py-3 text-sm hover:bg-gray-50">
                        SPMB
                    </a>

                    <a href="#berita" class="block rounded-xl px-4 py-3 text-sm hover:bg-gray-50">
                        Berita
                    </a>

                    <a href="#fasilitas" class="block rounded-xl px-4 py-3 text-sm hover:bg-gray-50">
                        Fasilitas
                    </a>
                </div>
            </div>

            <a href="#visi-misi"
               class="text-sm font-medium text-primary transition hover:text-secondary">
                Visi & Misi
            </a>

            <!-- DROPDOWN PROFIL -->
            <div class="relative" x-on:click.outside="profileOpen = false">

                <button
                    type="button"
                    x-on:click="profileOpen = !profileOpen; infoOpen = false"
                    x-bind:aria-expanded="profileOpen.toString()"
                    class="flex items-center gap-2 text-sm font-medium text-primary transition hover:text-secondary"
                >
                    Profil Sekolah
                    <span>⌄</span>
                </button>

                <div
                    x-show="profileOpen"
                    x-cloak
                    x-transition
                    class="absolute right-0 top-10 w-56 rounded-2xl border border-gray-100 bg-white p-2 shadow-xl"
                >
                    <a href="#profil" class="block rounded-xl px-4 py-3 text-sm hover:bg-gray-50">
                        Tentang Sekolah
                    </a>

                    <a href="#struktur" class="block rounded-xl px-4 py-3 text-sm hover:bg-gray-50">
                        Struktur Organisasi
                    </a>

                    <a href="#kepala-sekolah" class="block rounded-xl px-4 py-3 text-sm hover:bg-gray-50">
                        Kepala Madrasah
                    </a>
                </div>
            </div>
        </nav>

        <!-- CTA DESKTOP -->
        <a href="#spmb"
           class="hidden rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white transition duration-300 hover:bg-secondary lg:inline-flex">
            Info SPMB ↗
        </a>

        <!-- TOMBOL MOBILE -->
        <button
            type="button"
            x-on:click="mobileOpen = !mobileOpen"
            x-bind:aria-expanded="mobileOpen.toString()"
            aria-label="Buka menu navigasi"
            class="rounded-lg p-2 text-2xl text-primary lg:hidden"
        >
            <span x-text="mobileOpen ? '✕' : '☰'"></span>
        </button>
    </div>

    <!-- MENU MOBILE -->
    <nav
        x-show="mobileOpen"
        x-cloak
        x-transition
        class="border-t border-gray-100 bg-white px-6 py-5 lg:hidden"
    >
        <div class="flex flex-col gap-5 text-sm font-medium text-primary">

            <a href="#beranda" x-on:click="mobileOpen = false">
                Beranda
            </a>

            <p class="text-xs font-bold uppercase tracking-widest text-secondary">
                Informasi
            </p>

            <a href="#spmb" x-on:click="mobileOpen = false">SPMB</a>
            <a href="#berita" x-on:click="mobileOpen = false">Berita</a>
            <a href="#fasilitas" x-on:click="mobileOpen = false">Fasilitas</a>

            <a href="#visi-misi" x-on:click="mobileOpen = false">
                Visi & Misi
            </a>

            <p class="text-xs font-bold uppercase tracking-widest text-secondary">
                Profil Sekolah
            </p>

            <a href="#profil" x-on:click="mobileOpen = false">
                Tentang Sekolah
            </a>

            <a href="#struktur" x-on:click="mobileOpen = false">
                Struktur Organisasi
            </a>

            <a href="#kepala-sekolah" x-on:click="mobileOpen = false">
                Kepala Madrasah
            </a>
        </div>
    </nav>
</header>
