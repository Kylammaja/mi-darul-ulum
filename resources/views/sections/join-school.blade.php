{{-- Section ajakan bergabung, letakkan sebelum footer di Beranda --}}
@php
    // Area foto sengaja kosong. Saat foto tersedia, simpan dengan nama berikut.
    $fotoBergabung = [
        ['file' => 'images/bergabung/murid-01.jpg', 'alt' => 'Foto murid 1'],
        ['file' => 'images/bergabung/guru-01.jpg',  'alt' => 'Foto guru 1'],
        ['file' => 'images/bergabung/murid-02.jpg', 'alt' => 'Foto murid 2'],
        ['file' => 'images/bergabung/murid-03.jpg', 'alt' => 'Foto murid 3'],
        ['file' => 'images/bergabung/guru-02.jpg',  'alt' => 'Foto guru 2'],
        ['file' => 'images/bergabung/murid-04.jpg', 'alt' => 'Foto murid 4'],
        ['file' => 'images/bergabung/murid-05.jpg', 'alt' => 'Foto murid 5'],
        ['file' => 'images/bergabung/guru-03.jpg',  'alt' => 'Foto guru 3'],
        ['file' => 'images/bergabung/murid-06.jpg', 'alt' => 'Foto murid 6'],
        ['file' => 'images/bergabung/murid-07.jpg', 'alt' => 'Foto murid 7'],
        ['file' => 'images/bergabung/guru-04.jpg',  'alt' => 'Foto guru 4'],
        ['file' => 'images/bergabung/murid-08.jpg', 'alt' => 'Foto murid 8'],
    ];
@endphp

<section id="ajak-bergabung" class="join-section relative isolate overflow-hidden bg-gradient-to-b from-white via-[#F2F8F6] to-white py-20 sm:py-24 lg:py-28">
    {{-- Section terbuka: tidak memakai panel/card pembungkus --}}
    <div class="relative mx-auto max-w-7xl">
        {{-- Dekorasi halus langsung pada background section --}}
        <div class="join-lines pointer-events-none absolute inset-0" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -left-20 bottom-0 h-72 w-72 rounded-full bg-secondary/5 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-20 top-0 h-72 w-72 rounded-full bg-primary/5 blur-3xl" aria-hidden="true"></div>

        {{-- Kolase foto melayang; akan kosong jika file gambar belum ada --}}
        <div class="join-gallery relative mx-auto h-[235px] max-w-[1140px] sm:h-[285px] lg:h-[315px]" aria-label="Galeri foto murid dan guru">
            @foreach ($fotoBergabung as $foto)
                <div class="join-photo join-animate absolute overflow-hidden rounded-xl border border-white/80 bg-[#E0EFEB] shadow-[0_10px_24px_rgba(0,56,68,0.10)] sm:rounded-2xl">
                    @if (file_exists(public_path($foto['file'])))
                        <img
                            src="{{ asset($foto['file']) }}"
                            alt="{{ $foto['alt'] }}"
                            loading="lazy"
                            class="h-full w-full object-cover transition-transform duration-700 hover:scale-110"
                        >
                    @else
                        {{-- Placeholder kosong, tanpa foto atau ikon --}}
                        <div class="h-full w-full bg-gradient-to-br from-[#ECF6F2] to-[#CCE5DE]" aria-hidden="true"></div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Ajakan utama --}}
        <div class="relative z-10 mx-auto max-w-4xl px-5 pb-4 text-center sm:px-10 sm:pb-8 lg:pb-10">
            <span class="join-animate mb-5 inline-flex items-center gap-2 rounded-full bg-secondary/10 px-5 py-2 text-xs font-bold tracking-wide text-secondary">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="m3 10 9-5 9 5-9 5-9-5Zm4 3v4c3 3 7 3 10 0v-4M21 10v7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                AYO BERGABUNG
            </span>

            <h2 class="join-animate font-heading text-3xl font-extrabold leading-tight tracking-tight text-primary sm:text-4xl lg:text-5xl">
                Bersama MI Darul Ulum Gedongan,
                <span class="block text-secondary">Tumbuh, Belajar, dan Berprestasi.</span>
            </h2>

            <p class="join-animate mx-auto mt-6 max-w-2xl font-body text-sm leading-7 text-slate-600 sm:text-base sm:leading-8">
                Mari bergabung bersama keluarga besar MI Darul Ulum Gedongan.
                Temukan lingkungan belajar yang mendukung perkembangan ilmu,
                karakter, dan potensi setiap anak.
            </p>

            <a
                href="{{ url('/informasi/spmb') }}"
                class="join-animate group mt-9 inline-flex items-center justify-center gap-3 rounded-full bg-secondary px-7 py-4 text-sm font-bold text-white shadow-lg shadow-secondary/20 transition duration-300 hover:-translate-y-1 hover:bg-primary hover:shadow-xl focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-secondary sm:px-9"
            >
                Daftar SPMB Sekarang
                <span class="text-lg transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true">↗</span>
            </a>
        </div>
    </div>
</section>

<style>
    /* Garis vertikal samar sebagai dekorasi section, tanpa card */
    #ajak-bergabung .join-lines {
        background-image: repeating-linear-gradient(
            90deg,
            transparent 0,
            transparent calc(12.5% - 1px),
            rgba(0,107,102,0.055) calc(12.5% - 1px),
            rgba(0,107,102,0.055) 12.5%
        );
        mask-image: linear-gradient(to bottom, black, transparent 78%);
    }

    /* Posisi 12 slot foto melayang di desktop; hanya slot foto yang berbentuk card */
    #ajak-bergabung .join-photo { width: 10.5%; height: 49%; }
    #ajak-bergabung .join-photo:nth-child(1)  { left: 3%;  top: 27%; }
    #ajak-bergabung .join-photo:nth-child(2)  { left: 11%; top: 7%;  height: 47%; }
    #ajak-bergabung .join-photo:nth-child(3)  { left: 20%; top: 25%; height: 45%; }
    #ajak-bergabung .join-photo:nth-child(4)  { left: 29%; top: 9%;  height: 48%; }
    #ajak-bergabung .join-photo:nth-child(5)  { left: 38%; top: 25%; height: 38%; }
    #ajak-bergabung .join-photo:nth-child(6)  { left: 49%; top: 12%; height: 46%; }
    #ajak-bergabung .join-photo:nth-child(7)  { left: 58%; top: 26%; height: 38%; }
    #ajak-bergabung .join-photo:nth-child(8)  { left: 67%; top: 9%;  height: 48%; }
    #ajak-bergabung .join-photo:nth-child(9)  { left: 76%; top: 24%; height: 47%; }
    #ajak-bergabung .join-photo:nth-child(10) { left: 85%; top: 7%;  height: 46%; }
    #ajak-bergabung .join-photo:nth-child(11) { left: 3%;  top: 73%; height: 25%; width: 8%; }
    #ajak-bergabung .join-photo:nth-child(12) { left: 88%; top: 58%; height: 34%; width: 9%; }

    #ajak-bergabung .join-photo { transition: box-shadow .35s ease, translate .35s ease; }
    #ajak-bergabung .join-photo:hover { translate: 0 -7px; box-shadow: 0 18px 36px rgba(0,56,68,.17); }

    /* Mobile: kartu lebih kecil dan tetap tersebar di bagian atas */
    @media (max-width: 639px) {
        #ajak-bergabung .join-photo { width: 22%; height: 43%; }
        #ajak-bergabung .join-photo:nth-child(1)  { left: 3%;  top: 15%; }
        #ajak-bergabung .join-photo:nth-child(2)  { left: 22%; top: 3%;  height: 46%; }
        #ajak-bergabung .join-photo:nth-child(3)  { left: 42%; top: 23%; }
        #ajak-bergabung .join-photo:nth-child(4)  { left: 62%; top: 5%;  height: 46%; }
        #ajak-bergabung .join-photo:nth-child(5)  { left: 79%; top: 22%; width: 19%; }
        #ajak-bergabung .join-photo:nth-child(6)  { left: 7%;  top: 60%; width: 18%; height: 33%; }
        #ajak-bergabung .join-photo:nth-child(7)  { left: 29%; top: 55%; width: 18%; height: 34%; }
        #ajak-bergabung .join-photo:nth-child(8)  { left: 54%; top: 61%; width: 18%; height: 33%; }
        #ajak-bergabung .join-photo:nth-child(9)  { left: 76%; top: 62%; width: 18%; height: 33%; }
        #ajak-bergabung .join-photo:nth-child(n+10) { display: none; }
    }
</style>

<script>
(() => {
    const section = document.getElementById('ajak-bergabung');
    if (!section || section.dataset.joinInitialized === '1') return;
    section.dataset.joinInitialized = '1';

    if (!('IntersectionObserver' in window) ||
        window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const items = section.querySelectorAll('.join-animate');
    const observer = new IntersectionObserver((entries, obs) => {
        for (const entry of entries) {
            if (!entry.isIntersecting) continue;
            const item = entry.target;
            const order = Array.from(items).indexOf(item);
            const isPhoto = item.classList.contains('join-photo');
            const animation = item.animate([
                { opacity: 0, transform: `translateY(${isPhoto ? -18 : 25}px) scale(.97)`, filter: 'blur(4px)' },
                { opacity: 1, transform: 'translateY(0) scale(1)', filter: 'blur(0)' }
            ], {
                duration: 750,
                delay: isPhoto ? (order % 6) * 65 : (order - 12) * 110,
                easing: 'cubic-bezier(.22,1,.36,1)',
                fill: 'both'
            });
            animation.onfinish = () => animation.cancel();
            obs.unobserve(item);
        }
    }, { threshold: 0.1, rootMargin: '0px 0px -15px 0px' });

    items.forEach(item => observer.observe(item));
})();
</script>
