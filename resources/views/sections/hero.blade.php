
{{-- HERO BERANDA --}}
<section
    id="beranda"
    class="relative isolate overflow-hidden bg-white lg:min-h-[100svh]"
>

    {{-- BACKGROUND DECORATION --}}
    <div
        aria-hidden="true"
        class="pointer-events-none absolute -left-32 top-28 h-72 w-72 rounded-full bg-secondary/5 blur-3xl"
    ></div>

    <div
        aria-hidden="true"
        class="pointer-events-none absolute -right-24 bottom-12 h-80 w-80 rounded-full bg-secondary/10 blur-3xl"
    ></div>

   
{{-- MAIN CONTAINER --}}
<div
    class="relative mx-auto grid w-full max-w-7xl
           grid-cols-1 items-center
           gap-10 px-6
           pb-14 pt-[116px]

           sm:gap-12 sm:px-8 sm:pb-20 sm:pt-32

           lg:min-h-[100svh]
           lg:grid-cols-2 lg:gap-16
           lg:px-10 lg:pb-20 lg:pt-28"
>


        {{-- =====================================
             TEKS HERO - SEBELAH KIRI
        ===================================== --}}
        <div
            class="hero-enter mx-auto w-full max-w-[580px]
                   text-center lg:mx-0 lg:text-left"
        >

            {{-- LABEL WELCOME --}}
            <div
                class="mb-5 inline-flex items-center
                       justify-center gap-3 rounded-full
                       border border-secondary/15
                       bg-secondary/5
                       px-4 py-2.5
                       sm:px-5 lg:mb-7"
            >

                <span
                    class="h-2 w-2 shrink-0 rounded-full bg-secondary"
                ></span>

                <span
                    class="text-[11px] font-bold tracking-wide
                           text-secondary sm:text-xs"
                >
                    Selamat Datang di Madrasah Kami
                </span>

            </div>

            {{-- HEADING --}}
            <h1
                class="mx-auto max-w-[520px]
                       font-heading
                       text-[clamp(2.1rem,8.5vw,2.6rem)]
                       font-extrabold
                       leading-[1.17]
                       tracking-[-0.045em]
                       text-primary

                       sm:text-5xl

                       lg:mx-0
                       lg:text-[clamp(2.35rem,3.6vw,3.75rem)]"
            >

                Membangun

                <span class="block text-secondary">
                    Generasi Hebat,
                </span>

                <span class="block">
                    untuk Masa Depan.
                </span>

            </h1>

            {{-- DESCRIPTION --}}
            <p
                class="mx-auto mt-5 max-w-[460px]
                       font-body text-sm leading-7
                       text-slate-600

                       sm:mt-6 sm:text-base sm:leading-8

                       lg:mx-0 lg:max-w-[500px]"
            >

                MI Darul Ulum Gedongan hadir sebagai tempat
                belajar, bertumbuh, dan mengembangkan potensi
                anak melalui pendidikan yang berlandaskan
                nilai-nilai Islam.

            </p>

            {{-- =====================================
                 BUTTONS
            ===================================== --}}
            <div
                class="mt-7 flex flex-wrap
                       items-center justify-center
                       gap-x-5 gap-y-4

                       sm:mt-8
                       lg:justify-start lg:gap-x-6"
            >

                {{-- BUTTON PRIMARY --}}
                <a
                    href="#kepala-sekolah"
                    class="group inline-flex items-center
                           justify-center gap-3
                           rounded-full bg-primary
                           px-7 py-3.5
                           text-sm font-bold text-white

                           shadow-[0_8px_18px_rgba(0,56,68,0.12)]

                           transition duration-300
                           hover:-translate-y-1
                           hover:bg-secondary"
                >

                    Jelajahi Sekolah

                    <span
                        aria-hidden="true"
                        class="transition-transform
                               group-hover:translate-x-1"
                    >
                        ↗
                    </span>

                </a>

                {{-- BUTTON SECONDARY --}}
                <a
                    href="#visi-misi"
                    class="inline-flex items-center
                           justify-center gap-2
                           text-sm font-bold text-primary
                           transition hover:text-secondary"
                >

                    Visi & Misi

                    <span aria-hidden="true">
                        →
                    </span>

                </a>

            </div>

            {{-- DETAIL BAWAH --}}
            <div
                class="mt-8 flex items-center
                       justify-center gap-3

                       sm:mt-10
                       lg:justify-start lg:gap-4"
            >

                <span
                    aria-hidden="true"
                    class="h-px w-8 bg-secondary
                           sm:w-10"
                ></span>

                <p
                    class="text-[11px] font-medium
                           tracking-wide text-slate-500
                           sm:text-xs"
                >

                    Berilmu • Berakhlak • Berkembang

                </p>

            </div>

        </div>

        {{-- =====================================
             FOTO GEDUNG SEKOLAH
        ===================================== --}}
        <div
            class="animate-fade-in relative mx-auto
                   w-full max-w-[480px] pb-7

                   lg:max-w-[535px] lg:pb-5"
        >

            {{-- AKSEN GEOMETRIS --}}
            <div
                aria-hidden="true"
                class="absolute -right-2 -top-2
                       h-full w-full
                       rounded-[26px]
                       border border-secondary/15

                       sm:-right-3 sm:-top-3
                       sm:rounded-[30px]"
            ></div>

            {{-- PHOTO CONTAINER --}}
            <div
                class="relative overflow-hidden
                       rounded-[24px]
                       border-4 border-white
                       bg-[#E8F4F0]

                       shadow-[0_18px_45px_rgba(0,56,68,0.14)]

                       sm:rounded-[28px] sm:border-[5px]"
            >

                @if (file_exists(public_path('images/gedung-sekolah.webp')))

                    <img
                        src="{{ asset('images/gedung-sekolah.webp') }}"
                        alt="Gedung MI Darul Ulum Gedongan"
                        width="680"
                        height="510"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                        class="aspect-[4/3] w-full
                               object-cover object-center"
                    >

                @elseif (file_exists(public_path('images/hero-sekolah.png')))

                    <img
                        src="{{ asset('images/hero-sekolah.png') }}"
                        alt="MI Darul Ulum Gedongan"
                        loading="eager"
                        decoding="async"
                        class="aspect-[4/3] w-full
                               object-contain object-center"
                    >

                @else

                    {{-- PLACEHOLDER --}}
                    <div
                        class="flex aspect-[4/3]
                               flex-col items-center
                               justify-center gap-3
                               px-6 text-center text-secondary"
                    >

                        <span
                            class="text-5xl"
                            aria-hidden="true"
                        >
                            🏫
                        </span>

                        <p class="font-heading text-sm font-bold">
                            Foto Gedung Sekolah
                        </p>

                        <p class="text-xs">
                            Simpan gedung-sekolah.webp di public/images
                        </p>

                    </div>

                @endif

            </div>

            {{-- =====================================
                 FLOATING INFO CARD
            ===================================== --}}
            <div
                class="absolute -bottom-1 left-1/2 z-10
                       flex w-max
                       max-w-[calc(100%-24px)]
                       -translate-x-1/2
                       items-center gap-3
                       rounded-2xl
                       border border-primary/10
                       bg-white px-4 py-3

                       shadow-[0_12px_28px_rgba(0,56,68,0.12)]

                       sm:left-0 sm:-translate-x-0
                       sm:px-5 sm:py-4

                       lg:-left-5"
            >

                {{-- ICON --}}
                <div
                    class="flex h-10 w-10 shrink-0
                           items-center justify-center
                           rounded-xl bg-secondary/10
                           text-xl text-secondary

                           sm:h-11 sm:w-11"
                >
                    ✦
                </div>

                {{-- TEXT --}}
                <div>

                    <p
                        class="font-heading text-xs
                               font-bold text-primary
                               sm:text-sm"
                    >
                        Pendidikan Berkualitas
                    </p>

                    <p
                        class="mt-1 text-[11px]
                               text-slate-500 sm:text-xs"
                    >
                        Tumbuh Bersama, Raih Prestasi
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
