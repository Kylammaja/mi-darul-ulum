<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kelola Berita') | Admin MI Darul Ulum Gedongan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Cropper.js 1.6.2: API getCroppedCanvas() digunakan oleh berita-crop.js --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <script defer src="{{ asset('js/berita-crop.js') }}"></script>
</head>
<body class="min-h-screen bg-[#F4F9F7] font-body text-primary">
    <header class="border-b border-primary/10 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-5 sm:px-8">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo madrasah" class="h-10 w-10 object-contain">
                <div class="leading-tight">
                    <p class="font-heading text-sm font-extrabold">MI DARUL ULUM</p>
                    <p class="text-xs font-semibold tracking-widest text-secondary">ADMIN MADRASAH</p>
                </div>
            </a>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="rounded-xl px-3 py-2 text-sm font-semibold hover:bg-secondary/10">Dashboard</a>
                <a href="{{ route('admin.berita.index') }}" class="rounded-xl bg-secondary/10 px-3 py-2 text-sm font-semibold text-secondary">Berita</a>
                <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="rounded-xl px-3 py-2 text-sm font-semibold hover:bg-secondary/10">Lihat Website ↗</a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-full bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-secondary">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-10 sm:px-8">
        @if (session('success'))
            <div role="status" class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-900">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
