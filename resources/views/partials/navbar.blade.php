
<!-- FLOATING NAVBAR -->
<header
    x-data="{
        mobileOpen: false,
        dropdown: null,
        scrolled: false
    }"
    x-init="scrolled = window.scrollY > 10"
    @scroll.window="scrolled = window.scrollY > 10"
    @keydown.escape.window="mobileOpen = false; dropdown = null"
    class="fixed inset-x-0 top-3 z-[90] sm:top-5"
>

    <div class="mx-auto max-w-6xl px-4 sm:px-6">

        <!-- NAVBAR CAPSULE -->
        <nav
            class="flex items-center justify-between gap-3 rounded-full border border-primary/10 bg-white/90 px-4 shadow-lg shadow-primary/10 backdrop-blur-xl transition-all duration-500 sm:px-5 lg:px-6"
            :class="scrolled
                ? 'h-16 bg-white/95 shadow-xl shadow-primary/15'
                : 'h-[76px]'"
            aria-label="Navigasi utama"
        >

            <!-- LOGO -->
            <a
                href="{{ route('home') }}"
                class="group flex shrink-0 items-center gap-3"
            >

                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary/10 p-1.5 transition duration-300 group-hover:rotate-6">

                    <img
                        src="{{ asset('images/logo-sekolah.png') }}"
                        alt="Logo MI Darul Ulum Gedongan"
                        class="h-full w-full object-contain"
                    >

                </div>

                <div class="leading-tight">

                    <h1 class="font-heading text-xs font-extrabold tracking-tight text-primary sm:text-sm">
                        MI DARUL ULUM
                    </h1>

                    <p class="mt-1 text-[9px] font-bold tracking-[0.18em] text-secondary">
                        GEDONGAN
                    </p>

                </div>

            </a>

            <!-- NAVIGASI DESKTOP -->
            <div class="hidden items-center gap-1 lg:flex">

                <!-- BERANDA -->
                <a
                    href="{{ route('home') }}"
                    class="rounded-full bg-secondary/10 px-4 py-2.5 text-sm font-bold text-secondary transition duration-300 hover:bg-secondary/15"
                >
                    Beranda
                </a>

                <!-- INFORMASI DROPDOWN -->
                <div
                    class="relative"
                    @mouseenter="dropdown = 'informasi'"
                    @mouseleave="dropdown = null"
                >

                    <button
                        type="button"
                        @click="dropdown = dropdown === 'informasi' ? null : 'informasi'"
                        :aria-expanded="(dropdown === 'informasi').toString()"
                        aria-haspopup="true"
                        class="flex items-center gap-1.5 rounded-full px-4 py-2.5 text-sm font-semibold text-primary transition duration-300 hover:bg-secondary/10 hover:text-secondary"
                    >
                        Informasi

                        <svg
                            class="h-4 w-4 transition-transform duration-300"
                            :class="dropdown === 'informasi' ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path d="m6 9 6 6 6-6"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div
                        x-cloak
                        x-show="dropdown === 'informasi'"
                        x-transition.opacity.duration.200ms
                        class="absolute left-0 top-full w-52 pt-4"
                    >

                        <div class="rounded-2xl border border-primary/10 bg-white/95 p-2 shadow-xl backdrop-blur-xl">

                            <a href="{{ url('/informasi/spmb') }}"
                               class="block rounded-xl px-4 py-3 text-sm font-medium text-primary transition hover:bg-secondary/10 hover:text-secondary">
                                SPMB
                            </a>

                            <a href="{{ url('/informasi/berita') }}"
                               class="block rounded-xl px-4 py-3 text-sm font-medium text-primary transition hover:bg-secondary/10 hover:text-secondary">
                                Berita Sekolah
                            </a>

                            <a href="{{ url('/informasi/fasilitas') }}"
                               class="block rounded-xl px-4 py-3 text-sm font-medium text-primary transition hover:bg-secondary/10 hover:text-secondary">
                                Fasilitas
                            </a>

                        </div>
                    </div>
                </div>

                <!-- VISI MISI -->
                <a
                    href="#visi-misi"
                    class="rounded-full px-4 py-2.5 text-sm font-semibold text-primary transition duration-300 hover:bg-secondary/10 hover:text-secondary"
                >
                    Visi & Misi
                </a>

                <!-- PROFIL DROPDOWN -->
                <div
                    class="relative"
                    @mouseenter="dropdown = 'profil'"
                    @mouseleave="dropdown = null"
                >

                    <button
                        type="button"
                        @click="dropdown = dropdown === 'profil' ? null : 'profil'"
                        :aria-expanded="(dropdown === 'profil').toString()"
                        aria-haspopup="true"
                        class="flex items-center gap-1.5 rounded-full px-4 py-2.5 text-sm font-semibold text-primary transition duration-300 hover:bg-secondary/10 hover:text-secondary"
                    >
                        Profil Sekolah

                        <svg
                            class="h-4 w-4 transition-transform duration-300"
                            :class="dropdown === 'profil' ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path d="m6 9 6 6 6-6"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div
                        x-cloak
                        x-show="dropdown === 'profil'"
                        x-transition.opacity.duration.200ms
                        class="absolute right-0 top-full w-56 pt-4"
                    >

                        <div class="rounded-2xl border border-primary/10 bg-white/95 p-2 shadow-xl backdrop-blur-xl">

                            <a href="#kepala-sekolah"
                               class="block rounded-xl px-4 py-3 text-sm font-medium text-primary transition hover:bg-secondary/10 hover:text-secondary">
                                Kepala Madrasah
                            </a>

                            <a href="{{ url('/profil') }}"
                               class="block rounded-xl px-4 py-3 text-sm font-medium text-primary transition hover:bg-secondary/10 hover:text-secondary">
                                Tentang Sekolah
                            </a>

                            <a href="{{ url('/profil/struktur-organisasi') }}"
                               class="block rounded-xl px-4 py-3 text-sm font-medium text-primary transition hover:bg-secondary/10 hover:text-secondary">
                                Struktur Organisasi
                            </a>

                        </div>
                    </div>
                </div>

            </div>

            <!-- TOMBOL SPMB DESKTOP -->
            <a
                href="{{ url('/informasi/spmb') }}"
                class="hidden shrink-0 items-center gap-2 rounded-full bg-secondary px-5 py-3 text-sm font-bold text-white shadow-md shadow-secondary/20 transition duration-300 hover:-translate-y-0.5 hover:bg-primary lg:inline-flex"
            >
                SPMB
                <span aria-hidden="true">↗</span>
            </a>

            <!-- HAMBURGER MOBILE -->
            <button
                type="button"
                @click="mobileOpen = !mobileOpen; dropdown = null"
                :aria-expanded="mobileOpen.toString()"
                aria-controls="floating-mobile-menu"
                aria-label="Buka atau tutup menu"
                class="flex h-11 w-11 items-center justify-center rounded-full bg-secondary/10 text-primary transition hover:bg-secondary/20 lg:hidden"
            >
                <svg
                    x-show="!mobileOpen"
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path d="M4 7h16M4 12h16M4 17h16"
                          stroke-linecap="round"/>
                </svg>

                <svg
                    x-cloak
                    x-show="mobileOpen"
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path d="M6 6l12 12M18 6L6 18"
                          stroke-linecap="round"/>
                </svg>
            </button>

        </nav>

        <!-- MOBILE FLOATING MENU -->
        <div
            id="floating-mobile-menu"
            x-cloak
            x-show="mobileOpen"
            x-transition.origin.top.duration.250ms
            class="mt-3 max-h-[calc(100dvh-115px)] overflow-y-auto rounded-[26px] border border-primary/10 bg-white/95 p-4 shadow-2xl shadow-primary/15 backdrop-blur-xl lg:hidden"
        >

            <div class="flex flex-col gap-1 text-sm font-semibold text-primary">

                <a
                    href="{{ route('home') }}"
                    @click="mobileOpen = false"
                    class="rounded-xl bg-secondary/10 px-4 py-3 text-secondary"
                >
                    Beranda
                </a>

                <!-- MOBILE INFORMASI -->
                <button
                    type="button"
                    @click="dropdown = dropdown === 'informasi' ? null : 'informasi'"
                    :aria-expanded="(dropdown === 'informasi').toString()"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-left hover:bg-secondary/10"
                >
                    Informasi
                    <span>⌄</span>
                </button>

                <div
                    x-cloak
                    x-show="dropdown === 'informasi'"
                    class="flex flex-col border-l-2 border-secondary/20 pl-4"
                >
                    <a href="{{ url('/informasi/spmb') }}" class="px-4 py-3">
                        SPMB
                    </a>

                    <a href="{{ url('/informasi/berita') }}" class="px-4 py-3">
                        Berita
                    </a>

                    <a href="{{ url('/informasi/fasilitas') }}" class="px-4 py-3">
                        Fasilitas
                    </a>
                </div>

                <a
                    href="#visi-misi"
                    @click="mobileOpen = false"
                    class="rounded-xl px-4 py-3 hover:bg-secondary/10"
                >
                    Visi & Misi
                </a>

                <!-- MOBILE PROFIL -->
                <button
                    type="button"
                    @click="dropdown = dropdown === 'profil' ? null : 'profil'"
                    :aria-expanded="(dropdown === 'profil').toString()"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-left hover:bg-secondary/10"
                >
                    Profil Sekolah
                    <span>⌄</span>
                </button>

                <div
                    x-cloak
                    x-show="dropdown === 'profil'"
                    class="flex flex-col border-l-2 border-secondary/20 pl-4"
                >

                    <a
                        href="#kepala-sekolah"
                        @click="mobileOpen = false"
                        class="px-4 py-3"
                    >
                        Kepala Madrasah
                    </a>

                    <a href="{{ url('/profil') }}" class="px-4 py-3">
                        Tentang Sekolah
                    </a>

                    <a href="{{ url('/profil/struktur-organisasi') }}"
                       class="px-4 py-3">
                        Struktur Organisasi
                    </a>

                </div>

                <a
                    href="{{ url('/informasi/spmb') }}"
                    class="mt-3 rounded-full bg-secondary px-5 py-3 text-center font-bold text-white transition hover:bg-primary"
                >
                    Informasi SPMB ↗
                </a>

            </div>
        </div>

    </div>
</header>

<!-- RUANG UNTUK NAVBAR FIXED -->
<div class="h-24 sm:h-28" aria-hidden="true"></div>
