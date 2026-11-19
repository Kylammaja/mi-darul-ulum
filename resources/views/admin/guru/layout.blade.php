<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Struktur Organisasi') | MI Darul Ulum Gedongan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F6F9F8] font-body text-[#003844]">
    <header class="border-b border-[#003844]/10 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5 lg:px-10">
            <div>
                <p class="text-xs font-bold uppercase tracking-[.18em] text-[#006B66]">Dashboard Admin</p>
                <h1 class="mt-1 font-heading text-xl font-extrabold">Struktur Organisasi</h1>
            </div>
            <nav class="flex flex-wrap items-center gap-2 text-sm font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-[#003844]/15 px-4 py-2.5 hover:bg-[#003844]/5">Dashboard</a>
                <a href="{{ route('profil.struktur-organisasi') }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-[#003844]/15 px-4 py-2.5 hover:bg-[#003844]/5">Lihat Halaman Publik ↗</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-8 lg:px-10 lg:py-12">
        @if (session('success'))
            <div role="status" class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-900">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div role="alert" class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                <p class="font-bold">Periksa kembali data berikut:</p>
                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
