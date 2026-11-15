
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | MI Darul Ulum Gedongan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-[#F4F9F7] px-5 font-body">

    <main class="w-full max-w-md rounded-3xl border border-slate-100 bg-white p-8 shadow-xl shadow-primary/10 sm:p-10">

        <div class="mb-8 text-center">

            <img
                src="{{ asset('images/logo-sekolah.png') }}"
                alt="Logo Sekolah"
                class="mx-auto mb-5 h-20 w-20 object-contain"
            >

            <h1 class="font-heading text-2xl font-extrabold text-primary">
                Login Admin
            </h1>

            <p class="mt-3 text-sm text-slate-500">
                MI Darul Ulum Gedongan
            </p>

        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}"
              class="space-y-5">
            @csrf

            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-primary">
                    Email Admin
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-secondary focus:ring-2 focus:ring-secondary/10"
                    placeholder="Masukkan email"
                >

                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-primary">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-secondary focus:ring-2 focus:ring-secondary/10"
                    placeholder="Masukkan password"
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-secondary px-6 py-3.5 text-sm font-bold text-white transition hover:bg-primary"
            >
                Masuk Dashboard
            </button>
        </form>

        <a href="{{ route('home') }}"
           class="mt-7 block text-center text-sm font-semibold text-secondary hover:text-primary">
            ← Kembali ke Beranda
        </a>

    </main>

</body>
</html>
