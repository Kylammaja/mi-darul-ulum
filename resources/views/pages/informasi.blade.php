@extends('layouts.inner')

@section('title', $title . ' | MI Darul Ulum Gedongan')

@section('content')
<section class="relative isolate overflow-hidden bg-[#F5FAF8] py-20 sm:py-24">
    <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-secondary/10 blur-3xl"></div>
    <div class="relative mx-auto max-w-6xl px-6 lg:px-10">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-secondary transition hover:text-primary">← Kembali ke Beranda</a>
        <div class="mt-10 max-w-3xl">
            <span class="inline-block rounded-full border border-secondary/15 bg-white px-4 py-2 text-xs font-bold tracking-[0.14em] text-secondary">{{ $label }}</span>
            <h1 class="mt-6 font-heading text-4xl font-extrabold leading-tight tracking-tight text-primary sm:text-5xl">{{ $title }}</h1>
            <p class="mt-6 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">{{ $description }}</p>
        </div>
    </div>
</section>

<section class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-6xl px-6 lg:px-10">
        <div class="mb-9">
            <h2 class="font-heading text-2xl font-bold text-primary">Informasi yang akan tersedia</h2>
            <p class="mt-2 text-sm text-slate-500">Konten masih disiapkan. Data resmi akan ditambahkan pada tahap berikutnya.</p>
        </div>
        <div class="grid gap-5 md:grid-cols-3">
            @foreach ($topics as $topic)
                <article class="rounded-3xl border border-primary/10 bg-[#F8FBFA] p-7 transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-primary/5">
                    <div class="mb-6 flex h-11 w-11 items-center justify-center rounded-2xl bg-secondary/10 font-heading text-lg font-bold text-secondary">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3 class="font-heading text-lg font-bold text-primary">{{ $topic['title'] }}</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-600">{{ $topic['description'] }}</p>
                </article>
            @endforeach
        </div>
        <a href="{{ route('home') }}" class="mt-10 inline-flex rounded-full bg-secondary px-6 py-3 text-sm font-bold text-white transition hover:bg-primary">Kembali ke Beranda ↗</a>
    </div>
</section>
@endsection
