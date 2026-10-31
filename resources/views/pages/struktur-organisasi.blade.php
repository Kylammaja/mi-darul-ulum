@extends('layouts.inner')

@section('title', 'Struktur Organisasi | MI Darul Ulum Gedongan')

@section('content')
@php
    /*
     | DATA CONTOH, BUKAN DATA RESMI MADRASAH.
     | Ganti nama, jabatan dan foto sesuai 15 guru yang sebenarnya.
     | Simpan foto PNG transparan di public/images/guru/guru-01.png, dst.
     */
    $guru = [];
    for ($i = 1; $i <= 15; $i++) {
        $guru[] = [
            'nama' => 'Nama Guru ' . str_pad($i, 2, '0', STR_PAD_LEFT),
            'jabatan' => $i === 1 ? 'Kepala Madrasah (contoh)' : 'Guru / Tenaga Pendidik',
            'foto' => 'images/guru/guru-' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.png',
        ];
    }
@endphp

<section id="struktur-organisasi" class="relative isolate overflow-hidden bg-white py-20 sm:py-24 lg:py-28">
    <!-- Dekorasi ringan sesuai warna website -->
    <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
        <div class="absolute -left-36 top-0 h-96 w-96 rounded-full bg-secondary/5 blur-3xl"></div>
        <div class="absolute -right-36 bottom-0 h-96 w-96 rounded-full bg-primary/5 blur-3xl"></div>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-10">
        <!-- Judul halaman -->
        <div class="mx-auto mb-14 max-w-3xl text-center">
            <span class="inline-flex rounded-full border border-secondary/15 bg-secondary/10 px-5 py-2 text-xs font-bold uppercase tracking-[0.17em] text-secondary">
                Tim Pendidik Madrasah
            </span>
            <h1 class="mt-5 font-heading text-3xl font-extrabold tracking-tight text-primary sm:text-4xl lg:text-5xl">
                Struktur <span class="text-secondary">Organisasi</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl font-body text-base leading-8 text-slate-600">
                Mengenal para pendidik dan pengelola MI Darul Ulum Gedongan.
            </p>
        </div>

        <!-- 15 kartu; 1 kolom HP kecil, 2 tablet, 3 laptop, 4 desktop lebar -->
        <div class="grid grid-cols-1 justify-items-center gap-x-6 gap-y-10 min-[520px]:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($guru as $orang)
                <article class="org-card group relative isolate h-[385px] w-full max-w-[310px] overflow-hidden rounded-[24px] border border-primary/10 bg-[#F4F8F6] shadow-[0_10px_28px_rgba(0,56,68,0.08)] transition-[box-shadow,border-color] duration-300 hover:border-secondary/30 hover:shadow-[0_22px_46px_rgba(0,56,68,0.16)]">
                    <!-- Panel vertikal seperti referensi, memakai warna sekolah -->
                    <div class="absolute inset-x-[20%] top-7 bottom-0 rounded-t-[22px] bg-gradient-to-b from-[#008579] via-secondary to-primary" aria-hidden="true"></div>
                    <div class="pointer-events-none absolute left-1/2 top-14 -translate-x-1/2 rotate-180 font-heading text-[72px] font-extrabold uppercase leading-none tracking-widest text-white/10 [writing-mode:vertical-rl]" aria-hidden="true">MADRASAH</div>
                    <div class="pointer-events-none absolute right-4 top-4 h-12 w-12 rounded-full border border-secondary/15" aria-hidden="true"></div>

                    <!-- Foto PNG transparan. Placeholder jika belum ada foto. -->
                    @if (file_exists(public_path($orang['foto'])))
                        <img
                            src="{{ asset($orang['foto']) }}"
                            alt="Foto {{ $orang['nama'] }}"
                            loading="lazy"
                            class="absolute inset-x-0 bottom-0 z-10 h-[94%] w-full object-contain object-bottom transition-transform duration-700 ease-out group-hover:scale-[1.045]"
                        >
                    @else
                        <div class="absolute inset-x-0 bottom-14 z-10 flex justify-center" aria-hidden="true">
                            <svg class="h-[245px] w-[205px] text-white/75 drop-shadow-lg" viewBox="0 0 205 245" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="102.5" cy="76" r="48" fill="currentColor"/>
                                <path d="M15 245v-28c0-55 38-91 87.5-91s87.5 36 87.5 91v28H15Z" fill="currentColor"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Gradien untuk keterbacaan nama, tidak menutupi desain foto -->
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 z-20 h-40 bg-gradient-to-t from-primary via-primary/85 to-transparent" aria-hidden="true"></div>
                    <div class="absolute inset-x-0 bottom-0 z-30 p-5 text-white">
                        <p class="font-heading text-lg font-extrabold leading-snug">{{ $orang['nama'] }}</p>
                        <p class="mt-1 text-xs font-medium text-emerald-100/90">{{ $orang['jabatan'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>

        <p class="mx-auto mt-12 max-w-2xl text-center text-sm leading-7 text-slate-500">
            Data nama, jabatan, dan foto saat ini masih berupa contoh untuk rancangan tampilan.
            Ganti dengan informasi resmi madrasah sebelum dipublikasikan.
        </p>
    </div>
</section>

<!-- Scroll reveal mandiri agar tidak bergantung pada selector JS Beranda -->
<script>
(function () {
    const cards = document.querySelectorAll('#struktur-organisasi .org-card');
    if (!cards.length) return;
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced || !('IntersectionObserver' in window)) return;

    const observer = new IntersectionObserver((entries, instance) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const card = entry.target;
            const index = Array.from(cards).indexOf(card);
            card.animate([
                { opacity: 0, transform: 'translateY(38px) scale(.96)', filter: 'blur(4px)' },
                { opacity: 1, transform: 'translateY(0) scale(1)', filter: 'blur(0)' },
            ], {
                duration: 800,
                delay: (index % 4) * 95,
                easing: 'cubic-bezier(.22,1,.36,1)',
            });
            instance.unobserve(card);
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -20px 0px' });

    cards.forEach((card) => observer.observe(card));
})();
</script>
@endsection
