
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F4F9F7] font-body">

    <main class="mx-auto max-w-6xl px-6 py-12">

        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="font-semibold text-secondary">
                    MI DARUL ULUM GEDONGAN
                </p>

                <h1 class="mt-3 font-heading text-3xl font-bold text-primary">
                    Dashboard Admin
                </h1>

                <p class="mt-3 text-slate-500">
                    Selamat datang, {{ auth()->user()->name }}.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <button
                    class="rounded-full bg-primary px-6 py-3 text-sm font-bold text-white transition hover:bg-secondary"
                >
                    Logout
                </button>
            </form>
        </div>

        
<div class="mt-10 rounded-3xl bg-white p-8 shadow-sm">

    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-heading text-xl font-bold text-primary">
                Manajemen Berita & Prestasi
            </h2>

            <p class="mt-3 text-sm leading-7 text-slate-500">
                Kelola informasi, kegiatan, dan prestasi
                MI Darul Ulum Gedongan melalui Dashboard Admin.
            </p>
        </div>

        <a
            href="{{ route('admin.berita.index') }}"
            class="inline-flex shrink-0 items-center justify-center gap-3
                   rounded-full bg-secondary px-6 py-3.5
                   text-sm font-bold text-white
                   transition duration-300
                   hover:-translate-y-1 hover:bg-primary"
        >
            Kelola Berita
            <span>↗</span>
        </a>

    </div>

</div>


    </main>

</body>
</html>
