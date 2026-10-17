
<section
    id="visi-misi"
    x-data="{ activeCard: null }"
    class="relative overflow-hidden bg-white py-20 sm:py-24 lg:py-28"
>
    <div class="mx-auto max-w-7xl px-6 lg:px-10">

        <!-- HEADER SECTION -->
        <div class="mb-12 flex flex-col justify-between gap-6 md:flex-row md:items-end">

            <!-- JUDUL -->
            <div>
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-secondary">
                    — Arah Pendidikan
                </p>

                <h2 class="font-heading text-3xl font-extrabold tracking-tight text-primary sm:text-4xl lg:text-5xl">
                    <span class="text-secondary">
                        Visi & Misi
                    </span>
                    Sekolah
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-slate-500 sm:text-base">
                    Mengenal arah, komitmen, dan tujuan pendidikan
                    MI Darul Ullum Gedongan dalam membentuk generasi masa depan.
                </p>
            </div>

            <!-- BUTTON KANAN -->
            <a
                href="#profil"
                class="group inline-flex w-fit items-center gap-5 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white transition-colors duration-300 hover:bg-secondary"
            >
                Kenali Madrasah

                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-primary">
                    ↗
                </span>
            </a>

        </div>


        <!-- GRID 3 CARD -->
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            <!-- CARD VISI -->
            <article
                class="group flex min-h-[290px] flex-col rounded-2xl border border-transparent bg-[#F5F7F7] p-7 transition-all duration-300 hover:border-secondary/20 hover:bg-[#EFF7F5] hover:shadow-xl hover:shadow-primary/5"
            >

                <div class="mb-8 flex h-13 w-13 items-center justify-center rounded-xl bg-white text-secondary shadow-sm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle cx="12" cy="12" r="9" />
                        <circle cx="12" cy="12" r="5" />
                        <circle cx="12" cy="12" r="1" />
                    </svg>
                </div>

                <h3 class="font-heading text-xl font-bold text-primary">
                    Visi Madrasah
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-500">
                    Mewujudkan generasi yang beriman, berakhlak mulia,
                    cerdas, mandiri, dan berprestasi.
                </p>

                <button
                    type="button"
                    x-on:click="activeCard = activeCard === 'visi' ? null : 'visi'"
                    x-bind:aria-expanded="(activeCard === 'visi').toString()"
                    class="mt-auto flex items-center gap-2 pt-8 text-left text-sm font-bold text-primary transition-colors hover:text-secondary"
                >
                    Selengkapnya
                    <span class="text-secondary">↗</span>
                </button>

            </article>


            <!-- CARD MISI -->
            <article
                class="group flex min-h-[290px] flex-col rounded-2xl border border-transparent bg-[#F5F7F7] p-7 transition-all duration-300 hover:border-secondary/20 hover:bg-[#EFF7F5] hover:shadow-xl hover:shadow-primary/5"
            >

                <div class="mb-8 flex h-13 w-13 items-center justify-center rounded-xl bg-white text-secondary shadow-sm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.5C9 4.5 5.5 4.5 3 5.5V19c3-1.2 6.5-1 9 1 2.5-2 6-2.2 9-1V5.5c-2.5-1-6-1-9 1Z"
                        />
                        <path d="M12 6.5V20" />
                    </svg>
                </div>

                <h3 class="font-heading text-xl font-bold text-primary">
                    Misi Madrasah
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-500">
                    Menyelenggarakan pendidikan Islami yang aktif,
                    kreatif, menyenangkan, dan berorientasi pada perkembangan siswa.
                </p>

                <button
                    type="button"
                    x-on:click="activeCard = activeCard === 'misi' ? null : 'misi'"
                    x-bind:aria-expanded="(activeCard === 'misi').toString()"
                    class="mt-auto flex items-center gap-2 pt-8 text-left text-sm font-bold text-primary transition-colors hover:text-secondary"
                >
                    Selengkapnya
                    <span class="text-secondary">↗</span>
                </button>

            </article>


            <!-- CARD TUJUAN -->
            <article
                class="group flex min-h-[290px] flex-col rounded-2xl border border-transparent bg-[#F5F7F7] p-7 transition-all duration-300 hover:border-secondary/20 hover:bg-[#EFF7F5] hover:shadow-xl hover:shadow-primary/5"
            >

                <div class="mb-8 flex h-13 w-13 items-center justify-center rounded-xl bg-white text-secondary shadow-sm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2L12 17.3l-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3Z"
                        />
                    </svg>
                </div>

                <h3 class="font-heading text-xl font-bold text-primary">
                    Tujuan Pendidikan
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-500">
                    Menciptakan lingkungan pendidikan yang mendukung
                    karakter, pengetahuan, kreativitas, dan potensi siswa.
                </p>

                <button
                    type="button"
                    x-on:click="activeCard = activeCard === 'tujuan' ? null : 'tujuan'"
                    x-bind:aria-expanded="(activeCard === 'tujuan').toString()"
                    class="mt-auto flex items-center gap-2 pt-8 text-left text-sm font-bold text-primary transition-colors hover:text-secondary"
                >
                    Selengkapnya
                    <span class="text-secondary">↗</span>
                </button>

            </article>

        </div>

        <!-- PANEL DETAIL INTERAKTIF -->
        <div
            x-show="activeCard !== null"
            x-cloak
            x-transition.opacity.duration.250ms
            class="mt-6 rounded-2xl border border-secondary/15 bg-[#F0F8F6] p-7 sm:p-9"
        >
            <div class="flex items-start justify-between gap-5">
                <div>

                    <div x-show="activeCard === 'visi'">
                        <h3 class="font-heading text-xl font-bold text-primary">
                            Visi Madrasah
                        </h3>
                        <p class="mt-3 leading-8 text-slate-600">
                            Bagian ini nantinya berisi rumusan visi resmi
                            MI Darul Ullum Gedongan secara lengkap.
                        </p>
                    </div>

                    <div x-show="activeCard === 'misi'">
                        <h3 class="font-heading text-xl font-bold text-primary">
                            Misi Madrasah
                        </h3>
                        <p class="mt-3 leading-8 text-slate-600">
                            Bagian ini nantinya berisi poin-poin misi resmi
                            yang ditetapkan oleh pihak madrasah.
                        </p>
                    </div>

                    <div x-show="activeCard === 'tujuan'">
                        <h3 class="font-heading text-xl font-bold text-primary">
                            Tujuan Pendidikan
                        </h3>
                        <p class="mt-3 leading-8 text-slate-600">
                            Bagian ini nantinya berisi tujuan pendidikan
                            resmi yang ingin dicapai oleh madrasah.
                        </p>
                    </div>

                </div>

                <button
                    type="button"
                    x-on:click="activeCard = null"
                    aria-label="Tutup detail"
                    class="rounded-full bg-white px-3 py-2 text-primary hover:bg-gray-100"
                >
                    ✕
                </button>
            </div>
        </div>

    </div>
</section>
