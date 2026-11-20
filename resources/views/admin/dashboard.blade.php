@php
    // Data untuk ringkasan dashboard. Tidak perlu mengubah route dashboard yang sudah ada.
    $beritaReady = class_exists(\App\Models\Berita::class)
        && \Illuminate\Support\Facades\Schema::hasTable('beritas');
    $guruReady = class_exists(\App\Models\Guru::class)
        && \Illuminate\Support\Facades\Schema::hasTable('gurus');

    $jumlahBerita = $beritaReady ? \App\Models\Berita::count() : null;
    $beritaPublik = $beritaReady ? \App\Models\Berita::where('is_published', true)->count() : null;
    $beritaDraft = $beritaReady ? \App\Models\Berita::where('is_published', false)->count() : null;
    $guruAktif = $guruReady ? \App\Models\Guru::where('is_active', true)->count() : null;
    $beritaTerbaru = $beritaReady
        ? \App\Models\Berita::query()->latest()->limit(4)->get()
        : collect();

    $namaAdmin = auth()->user()?->name ?: 'Admin Madrasah';
    $inisialAdmin = mb_strtoupper(mb_substr(trim($namaAdmin), 0, 1));
    $tanggalHariIni = now()->locale('id')->translatedFormat('l, d F Y');

    $routeBerita = \Illuminate\Support\Facades\Route::has('admin.berita.index');
    $routeTambahBerita = \Illuminate\Support\Facades\Route::has('admin.berita.create');
    $routeGuru = \Illuminate\Support\Facades\Route::has('admin.struktur-organisasi.index');
    $routeTambahGuru = \Illuminate\Support\Facades\Route::has('admin.struktur-organisasi.create');
    $alamatWebsite = \Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#003844">
    <title>Dashboard Admin | MI Darul Ulum Gedongan</title>

    <style>
        :root {
            --adm-primary: #003844;
            --adm-secondary: #006B66;
            --adm-bg: #F4F8F7;
            --adm-ink: #153B43;
            --adm-muted: #72868B;
            --adm-border: #E3ECEA;
            --adm-white: #FFFFFF;
            --adm-shadow: 0 14px 40px rgba(5, 55, 63, .055);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; min-height: 100vh; background: var(--adm-bg); color: var(--adm-ink); font-family: 'Plus Jakarta Sans', 'DM Sans', Inter, system-ui, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }
        button, a { -webkit-tap-highlight-color: transparent; }
        button { font: inherit; cursor: pointer; }
        a { color: inherit; text-decoration: none; }
        a:focus-visible, button:focus-visible { outline: 3px solid #6ED4C2; outline-offset: 3px; }
        .adm-icon { width: 19px; height: 19px; flex-shrink: 0; stroke: currentColor; stroke-width: 1.8; fill: none; stroke-linecap: round; stroke-linejoin: round; }
        .adm-layout { min-height: 100vh; }

        /* Sidebar */
        .adm-sidebar { position: fixed; z-index: 45; inset: 0 auto 0 0; width: 258px; padding: 29px 17px 22px; background: var(--adm-primary); color: white; display: flex; flex-direction: column; overflow-y: auto; }
        .adm-brand { display: flex; align-items: center; gap: 12px; padding: 4px 11px 30px; border-bottom: 1px solid rgba(255,255,255,.11); }
        .adm-brand-mark { width: 45px; height: 45px; flex-shrink: 0; border-radius: 14px; background: white; display: flex; align-items: center; justify-content: center; overflow: hidden; color: var(--adm-primary); font-weight: 850; }
        .adm-brand-mark img { width: 38px; height: 38px; object-fit: contain; }
        .adm-brand-name { font-size: 13px; font-weight: 800; line-height: 1.38; letter-spacing: .025em; }
        .adm-brand-place { display: block; font-size: 9px; font-weight: 700; letter-spacing: .2em; margin-top: 4px; color: #8BC4BC; }
        .adm-side-title { margin: 29px 14px 12px; font-size: 10px; font-weight: 800; color: #79ACA9; letter-spacing: .17em; text-transform: uppercase; }
        .adm-side-nav { display: grid; gap: 5px; }
        .adm-side-link { min-height: 47px; display: flex; align-items: center; gap: 13px; padding: 0 14px; border-radius: 12px; color: #C7DFDC; font-size: 12px; font-weight: 650; transition: background .2s ease, color .2s ease; }
        .adm-side-link:hover { background: rgba(255,255,255,.095); color: #fff; }
        .adm-side-link.is-active { background: #0D5A61; color: #fff; box-shadow: inset 3px 0 0 #88E0D0; }
        .adm-side-link.is-disabled { color: #759B9A; cursor: default; }
        .adm-side-link.is-disabled:hover { background: transparent; color: #759B9A; }
        .adm-sidebar-bottom { margin-top: auto; padding-top: 24px; }
        .adm-side-divider { height: 1px; background: rgba(255,255,255,.11); margin-bottom: 13px; }
        .adm-logout { width: 100%; text-align: left; border: 0; background: transparent; }
        .adm-version { padding: 20px 14px 0; font-size: 10px; color: #729D9D; letter-spacing: .06em; }
        .adm-overlay { display: none; }
        .adm-overlay[hidden] { display: none !important; }

        /* Main area */
        .adm-main { min-width: 0; margin-left: 258px; padding: 27px clamp(24px, 4.1vw, 70px) 72px; }
        .adm-content { max-width: 1260px; margin: auto; }
        .adm-topbar { display: flex; justify-content: space-between; align-items: center; gap: 20px; margin-bottom: 29px; }
        .adm-crumb { display: flex; align-items: center; gap: 11px; color: #81969B; font-size: 12px; font-weight: 650; }
        .adm-crumb b { color: var(--adm-primary); font-weight: 800; }
        .adm-crumb .adm-slash { color: #B8C9C8; }
        .adm-topright { display: flex; align-items: center; gap: 14px; }
        .adm-date { color: #6B8589; font-size: 12px; font-weight: 600; white-space: nowrap; }
        .adm-topavatar { height: 39px; width: 39px; display: grid; place-items: center; border-radius: 50%; background: #DDF0EA; border: 3px solid white; color: var(--adm-secondary); font-weight: 800; box-shadow: 0 2px 12px rgba(3,66,68,.06); }
        .adm-menu-btn { display: none; border: 1px solid var(--adm-border); background: #fff; width: 40px; height: 40px; border-radius: 12px; color: var(--adm-primary); align-items: center; justify-content: center; }
        .adm-page-title { font-size: clamp(25px, 2.4vw, 32px); margin: 0; letter-spacing: -.045em; font-weight: 820; color: var(--adm-primary); }
        .adm-page-caption { margin: 7px 0 25px; font-size: 13px; color: #789094; line-height: 1.7; }

        /* Welcome banner */
        .adm-hero { position: relative; isolation: isolate; overflow: hidden; border-radius: 23px; min-height: 220px; padding: 35px 39px; background: linear-gradient(111deg, #003844 4%, #07545D 61%, #087A75 100%); color: white; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .adm-hero::before { content: ''; position: absolute; z-index: -1; width: 340px; height: 340px; right: 20px; top: -175px; border: 1px solid rgba(255,255,255,.15); border-radius: 50%; box-shadow: 0 0 0 52px rgba(255,255,255,.045), 0 0 0 109px rgba(255,255,255,.025); }
        .adm-hero::after { content: ''; position: absolute; z-index: -1; width: 190px; height: 190px; right: 25%; bottom: -142px; border-radius: 50%; background: rgba(127,220,200,.08); }
        .adm-kicker { font-size: 10px; font-weight: 800; letter-spacing: .21em; color: #8FE3D2; text-transform: uppercase; }
        .adm-hero h2 { margin: 15px 0 9px; font-size: clamp(23px, 2.2vw, 30px); font-weight: 800; line-height: 1.33; letter-spacing: -.04em; }
        .adm-hero p { color: #C7E1DF; font-size: 12px; line-height: 1.95; margin: 0; max-width: 480px; }
        .adm-hero-actions { display: flex; flex-shrink: 0; align-items: center; gap: 10px; flex-wrap: wrap; }
        .adm-hero-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; border: 1px solid rgba(255,255,255,.25); border-radius: 11px; min-height: 43px; padding: 0 17px; color: #fff; background: rgba(255,255,255,.09); font-weight: 750; font-size: 12px; transition: transform .2s ease, background .2s ease; }
        .adm-hero-btn:hover { background: rgba(255,255,255,.18); transform: translateY(-2px); }
        .adm-hero-btn.primary { color: #003844; background: #FFFFFF; border-color: white; }
        .adm-hero-btn.primary:hover { background: #E2F5EF; }
        .adm-hero-btn svg { width: 17px; height: 17px; }

        /* Stats */
        .adm-stats { margin-top: 23px; display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
        .adm-stat { background: white; border: 1px solid var(--adm-border); border-radius: 18px; padding: 20px 21px 17px; box-shadow: var(--adm-shadow); min-width: 0; }
        .adm-stat-top { display: flex; align-items: center; justify-content: space-between; gap: 10px; }
        .adm-stat-label { color: #647E84; font-size: 11px; font-weight: 700; }
        .adm-stat-icon { width: 37px; height: 37px; border-radius: 11px; background: #EAF5F1; color: var(--adm-secondary); display: grid; place-items: center; }
        .adm-stat-icon.blue { background: #EDF4FA; color: #4A83AA; }
        .adm-stat-icon.orange { background: #FFF4E8; color: #B57A34; }
        .adm-stat-value { display: block; margin-top: 12px; color: var(--adm-primary); font-size: 32px; letter-spacing: -.045em; font-weight: 820; line-height: 1; font-variant-numeric: tabular-nums; }
        .adm-stat-sub { display: block; margin-top: 10px; font-size: 10px; font-weight: 600; color: #93A6A8; }

        /* Sections / feature cards */
        .adm-section-head { margin: 33px 0 17px; display: flex; align-items: flex-end; justify-content: space-between; gap: 12px; }
        .adm-section-head h3 { margin: 0; color: var(--adm-primary); font-size: 18px; letter-spacing: -.028em; }
        .adm-section-head p { margin: 6px 0 0; color: #879B9F; font-size: 11px; line-height: 1.55; }
        .adm-feature-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .adm-feature { background: white; border: 1px solid var(--adm-border); border-radius: 20px; padding: 23px; box-shadow: var(--adm-shadow); min-width: 0; display: flex; flex-direction: column; }
        .adm-feature-upper { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; }
        .adm-feature-icon { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; background: #E4F3ED; color: var(--adm-secondary); }
        .adm-feature-icon.alt { background: #E6F0F5; color: #336B82; }
        .adm-feature-icon .adm-icon { width: 23px; height: 23px; }
        .adm-tag { border-radius: 99px; padding: 7px 10px; background: #F0F7F4; color: #33766A; font-size: 10px; font-weight: 800; white-space: nowrap; }
        .adm-feature h4 { color: var(--adm-primary); margin: 18px 0 7px; font-size: 16px; letter-spacing: -.015em; }
        .adm-feature p { color: #799093; font-size: 11px; line-height: 1.9; margin: 0 0 21px; max-width: 420px; }
        .adm-feature-actions { margin-top: auto; display: flex; gap: 10px; flex-wrap: wrap; }
        .adm-action { min-height: 39px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; border-radius: 10px; padding: 0 14px; background: var(--adm-secondary); color: white; font-size: 11px; font-weight: 750; transition: transform .2s ease, background .2s ease; }
        .adm-action:hover { background: var(--adm-primary); transform: translateY(-2px); }
        .adm-action.ghost { border: 1px solid #D9E7E4; background: #fff; color: var(--adm-primary); }
        .adm-action.ghost:hover { background: #EEF6F3; }
        .adm-action.is-disabled { background: #EFF4F3; color: #93A4A5; cursor: not-allowed; }
        .adm-action.is-disabled:hover { transform: none; }
        .adm-action svg { width: 15px; height: 15px; }

        /* Lower panels */
        .adm-lower-grid { display: grid; grid-template-columns: 1.48fr 1fr; gap: 18px; margin-top: 19px; }
        .adm-panel { background: white; border: 1px solid var(--adm-border); box-shadow: var(--adm-shadow); border-radius: 20px; min-width: 0; overflow: hidden; }
        .adm-panel-heading { padding: 23px 24px 16px; display: flex; justify-content: space-between; align-items: center; gap: 10px; }
        .adm-panel-heading h4 { margin: 0; font-size: 15px; color: var(--adm-primary); }
        .adm-panel-heading p { font-size: 11px; margin: 6px 0 0; color: #8EA0A3; }
        .adm-panel-heading a { font-size: 11px; font-weight: 750; color: var(--adm-secondary); white-space: nowrap; }
        .adm-panel-heading a:hover { text-decoration: underline; }
        .adm-news-row { display: flex; align-items: center; gap: 12px; padding: 14px 24px; border-top: 1px solid #F1F4F3; }
        .adm-news-mark { width: 38px; height: 38px; border-radius: 11px; flex-shrink: 0; display: grid; place-items: center; color: #16786F; background: #EAF5F1; }
        .adm-news-main { flex: 1; min-width: 0; }
        .adm-news-title { font-size: 12px; font-weight: 750; color: var(--adm-primary); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .adm-news-meta { margin-top: 5px; font-size: 10px; color: #8A9D9F; }
        .adm-status { padding: 6px 9px; font-size: 9px; white-space: nowrap; border-radius: 99px; font-weight: 800; color: #197766; background: #E9F7EF; }
        .adm-status.draft { color: #A67539; background: #FFF3E5; }
        .adm-empty { padding: 34px 24px 39px; border-top: 1px solid #F1F4F3; text-align: center; color: #8A9FA2; font-size: 12px; line-height: 1.8; }
        .adm-empty svg { color: #A2BFBA; width: 34px; height: 34px; margin-bottom: 10px; }
        .adm-tips { padding: 4px 24px 24px; }
        .adm-tip { display: flex; gap: 12px; padding: 15px 0; border-top: 1px solid #F0F4F3; }
        .adm-tip-num { width: 27px; height: 27px; flex-shrink: 0; border-radius: 9px; display: grid; place-items: center; background: #EAF5F1; color: var(--adm-secondary); font-size: 11px; font-weight: 800; }
        .adm-tip strong { display: block; font-size: 11px; color: var(--adm-primary); }
        .adm-tip small { display: block; margin-top: 5px; font-size: 10px; line-height: 1.7; color: #829699; }
        .adm-bottom-note { margin-top: 25px; text-align: center; font-size: 10px; color: #A1B3B4; }

        @media (max-width: 1180px) {
            .adm-main { padding-left: 32px; padding-right: 32px; }
            .adm-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .adm-hero { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 940px) {
            .adm-sidebar { transform: translateX(-102%); transition: transform .25s ease; box-shadow: 20px 0 55px rgba(0,0,0,.13); }
            .adm-sidebar.is-open { transform: translateX(0); }
            .adm-main { margin-left: 0; }
            .adm-menu-btn { display: inline-flex; }
            .adm-crumb { margin-right: auto; }
            .adm-overlay:not([hidden]) { display: block; position: fixed; inset: 0; z-index: 40; border: none; background: rgba(1,27,34,.45); }
        }
        @media (max-width: 700px) {
            .adm-main { padding: 19px 17px 45px; }
            .adm-date { display: none; }
            .adm-topbar { margin-bottom: 21px; }
            .adm-hero { padding: 25px 23px; border-radius: 19px; min-height: 0; }
            .adm-hero h2 { font-size: 24px; }
            .adm-hero-actions { width: 100%; }
            .adm-feature-grid, .adm-lower-grid { grid-template-columns: 1fr; }
            .adm-stats { gap: 11px; }
            .adm-stat { border-radius: 15px; padding: 16px; }
            .adm-stat-value { font-size: 28px; }
            .adm-feature { padding: 21px; }
            .adm-page-caption { margin-bottom: 20px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
<div class="adm-layout">
    <aside class="adm-sidebar" id="adminSidebar" aria-label="Navigasi Dashboard Admin">
        <a class="adm-brand" href="{{ route('admin.dashboard') }}">
            <span class="adm-brand-mark">
                @if (file_exists(public_path('images/logo-sekolah.png')))
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo MI Darul Ulum">
                @else
                    MI
                @endif
            </span>
            <span class="adm-brand-name">MI DARUL ULUM<span class="adm-brand-place">GEDONGAN</span></span>
        </a>

        <div class="adm-side-title">Menu utama</div>
        <nav class="adm-side-nav" aria-label="Menu utama">
            <a class="adm-side-link is-active" href="{{ route('admin.dashboard') }}" aria-current="page">
                <svg class="adm-icon" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>
        </nav>

        <div class="adm-side-title">Manajemen konten</div>
        <nav class="adm-side-nav" aria-label="Manajemen konten">
            @if ($routeBerita)
                <a class="adm-side-link" href="{{ route('admin.berita.index') }}">
                    <svg class="adm-icon" viewBox="0 0 24 24"><path d="M4 5h13a2 2 0 0 1 2 2v12H6a2 2 0 0 1-2-2z"/><path d="M8 9h7M8 13h7M8 17h4"/><path d="M19 8h1a1 1 0 0 1 1 1v8a2 2 0 0 1-2 2"/></svg>
                    Berita & Prestasi
                </a>
            @else
                <span class="adm-side-link is-disabled">Berita & Prestasi (belum aktif)</span>
            @endif
            @if ($routeGuru)
                <a class="adm-side-link" href="{{ route('admin.struktur-organisasi.index') }}">
                    <svg class="adm-icon" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 19v-2a6 6 0 0 1 12 0v2z"/><path d="M16 5a3 3 0 0 1 0 6M18 14a5 5 0 0 1 3 5"/></svg>
                    Struktur Organisasi
                </a>
            @else
                <span class="adm-side-link is-disabled">Struktur Organisasi (belum aktif)</span>
            @endif
        </nav>

        <div class="adm-sidebar-bottom">
            <div class="adm-side-divider"></div>
            <a class="adm-side-link" href="{{ $alamatWebsite }}" target="_blank" rel="noopener noreferrer">
                <svg class="adm-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c-2.3 2.5-3.5 5.5-3.5 9s1.2 6.5 3.5 9M12 3c2.3 2.5 3.5 5.5 3.5 9s-1.2 6.5-3.5 9"/></svg>
                Lihat Website
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="adm-side-link adm-logout" type="submit">
                    <svg class="adm-icon" viewBox="0 0 24 24"><path d="M10 4H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5"/><path d="M13 8l4 4-4 4M7 12h10"/></svg>
                    Logout
                </button>
            </form>
            <div class="adm-version">© {{ date('Y') }} MI Darul Ulum Gedongan</div>
        </div>
    </aside>

    <button class="adm-overlay" id="adminOverlay" type="button" aria-label="Tutup menu" hidden></button>

    <main class="adm-main">
        <div class="adm-content">
            <header class="adm-topbar">
                <button class="adm-menu-btn" id="adminMenuButton" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="adminSidebar">
                    <svg class="adm-icon" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                </button>
                <div class="adm-crumb"><span>Admin Panel</span><span class="adm-slash">/</span><b>Dashboard</b></div>
                <div class="adm-topright">
                    <span class="adm-date">{{ $tanggalHariIni }}</span>
                    <span class="adm-topavatar" title="{{ $namaAdmin }}">{{ $inisialAdmin }}</span>
                </div>
            </header>

            <h1 class="adm-page-title">Dashboard Overview</h1>
            <p class="adm-page-caption">Pantau informasi dan kelola konten website madrasah dalam satu tempat.</p>

            <section class="adm-hero" aria-labelledby="welcome-title">
                <div>
                    <span class="adm-kicker">MI Darul Ulum Gedongan</span>
                    <h2 id="welcome-title">Selamat datang kembali,<br>{{ $namaAdmin }}.</h2>
                    <p>Kelola berita, prestasi, dan struktur organisasi madrasah dengan lebih mudah melalui panel administrasi.</p>
                </div>
                <div class="adm-hero-actions">
                    @if ($routeTambahBerita)
                        <a href="{{ route('admin.berita.create') }}" class="adm-hero-btn primary">
                            <svg class="adm-icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                            Tambah Berita
                        </a>
                    @endif
                    <a href="{{ $alamatWebsite }}" target="_blank" rel="noopener noreferrer" class="adm-hero-btn">
                        Lihat Website
                        <svg class="adm-icon" viewBox="0 0 24 24"><path d="M7 17 17 7M9 7h8v8"/></svg>
                    </a>
                </div>
            </section>

            <section class="adm-stats" aria-label="Ringkasan data">
                <article class="adm-stat">
                    <div class="adm-stat-top"><span class="adm-stat-label">Total Berita</span><span class="adm-stat-icon"><svg class="adm-icon" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/></svg></span></div>
                    <strong class="adm-stat-value">{{ $jumlahBerita ?? '—' }}</strong>
                    <span class="adm-stat-sub">{{ $beritaReady ? 'Semua berita tersimpan' : 'Tabel beritas belum tersedia' }}</span>
                </article>
                <article class="adm-stat">
                    <div class="adm-stat-top"><span class="adm-stat-label">Dipublikasikan</span><span class="adm-stat-icon"><svg class="adm-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="m8 12 2.5 2.5L16 9"/></svg></span></div>
                    <strong class="adm-stat-value">{{ $beritaPublik ?? '—' }}</strong>
                    <span class="adm-stat-sub">Berita tampil di website</span>
                </article>
                <article class="adm-stat">
                    <div class="adm-stat-top"><span class="adm-stat-label">Draft Berita</span><span class="adm-stat-icon orange"><svg class="adm-icon" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h6"/></svg></span></div>
                    <strong class="adm-stat-value">{{ $beritaDraft ?? '—' }}</strong>
                    <span class="adm-stat-sub">Belum dipublikasikan</span>
                </article>
                <article class="adm-stat">
                    <div class="adm-stat-top"><span class="adm-stat-label">Guru Aktif</span><span class="adm-stat-icon blue"><svg class="adm-icon" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 19v-2a6 6 0 0 1 12 0v2z"/><path d="M16 5a3 3 0 0 1 0 6M18 14a5 5 0 0 1 3 5"/></svg></span></div>
                    <strong class="adm-stat-value">{{ $guruAktif ?? '—' }}</strong>
                    <span class="adm-stat-sub">{{ $guruReady ? 'Ditampilkan di struktur organisasi' : 'Tabel gurus belum tersedia' }}</span>
                </article>
            </section>

            <div class="adm-section-head">
                <div><h3>Manajemen Konten</h3><p>Pilih bagian website yang ingin kamu kelola.</p></div>
            </div>
            <section class="adm-feature-grid" aria-label="Menu manajemen konten">
                <article class="adm-feature">
                    <div class="adm-feature-upper"><div class="adm-feature-icon"><svg class="adm-icon" viewBox="0 0 24 24"><path d="M4 5h13a2 2 0 0 1 2 2v12H6a2 2 0 0 1-2-2z"/><path d="M8 9h7M8 13h7M8 17h4"/><path d="M19 8h1a1 1 0 0 1 1 1v8a2 2 0 0 1-2 2"/></svg></div><span class="adm-tag">Berita & Prestasi</span></div>
                    <h4>Kelola Berita Madrasah</h4>
                    <p>Tambah informasi kegiatan, unggah dokumentasi, edit berita, dan tentukan status publikasinya.</p>
                    <div class="adm-feature-actions">
                        @if ($routeBerita)
                            <a class="adm-action" href="{{ route('admin.berita.index') }}">Kelola Berita <span aria-hidden="true">↗</span></a>
                        @else
                            <span class="adm-action is-disabled">Route belum aktif</span>
                        @endif
                        @if ($routeTambahBerita)
                            <a class="adm-action ghost" href="{{ route('admin.berita.create') }}">+ Tambah Baru</a>
                        @endif
                    </div>
                </article>
                <article class="adm-feature">
                    <div class="adm-feature-upper"><div class="adm-feature-icon alt"><svg class="adm-icon" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><path d="M3 19v-2a6 6 0 0 1 12 0v2z"/><path d="M16 5a3 3 0 0 1 0 6M18 14a5 5 0 0 1 3 5"/></svg></div><span class="adm-tag">Data Guru</span></div>
                    <h4>Struktur Organisasi</h4>
                    <p>Kelola nama, jabatan, foto guru, urutan tampilan, dan status aktif untuk halaman profil sekolah.</p>
                    <div class="adm-feature-actions">
                        @if ($routeGuru)
                            <a class="adm-action" href="{{ route('admin.struktur-organisasi.index') }}">Kelola Guru <span aria-hidden="true">↗</span></a>
                        @else
                            <span class="adm-action is-disabled">Route belum aktif</span>
                        @endif
                        @if ($routeTambahGuru)
                            <a class="adm-action ghost" href="{{ route('admin.struktur-organisasi.create') }}">+ Tambah Guru</a>
                        @endif
                    </div>
                </article>
            </section>

            <div class="adm-lower-grid">
                <section class="adm-panel" aria-labelledby="recent-news-title">
                    <div class="adm-panel-heading">
                        <div><h4 id="recent-news-title">Berita Terbaru</h4><p>Empat berita terakhir yang disimpan</p></div>
                        @if ($routeBerita)<a href="{{ route('admin.berita.index') }}">Lihat Semua ↗</a>@endif
                    </div>
                    @forelse ($beritaTerbaru as $berita)
                        <div class="adm-news-row">
                            <span class="adm-news-mark"><svg class="adm-icon" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h6"/></svg></span>
                            <div class="adm-news-main">
                                <div class="adm-news-title">{{ $berita->judul }}</div>
                                <div class="adm-news-meta">{{ $berita->kategori ?: 'Berita' }} · {{ $berita->created_at?->format('d/m/Y') ?? '—' }}</div>
                            </div>
                            <span class="adm-status {{ $berita->is_published ? '' : 'draft' }}">{{ $berita->is_published ? 'Publik' : 'Draft' }}</span>
                        </div>
                    @empty
                        <div class="adm-empty">
                            <svg class="adm-icon" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h8"/></svg>
                            <div>Belum ada berita untuk ditampilkan.<br>Tambahkan berita melalui menu Kelola Berita.</div>
                        </div>
                    @endforelse
                </section>
                <section class="adm-panel" aria-labelledby="tips-title">
                    <div class="adm-panel-heading"><div><h4 id="tips-title">Panduan Singkat</h4><p>Alur memperbarui konten website</p></div></div>
                    <div class="adm-tips">
                        <div class="adm-tip"><span class="adm-tip-num">01</span><div><strong>Tambah konten</strong><small>Masukkan judul, informasi, dan foto melalui dashboard.</small></div></div>
                        <div class="adm-tip"><span class="adm-tip-num">02</span><div><strong>Periksa data</strong><small>Pastikan tulisan, foto, dan informasi sesuai dengan kegiatan sekolah.</small></div></div>
                        <div class="adm-tip"><span class="adm-tip-num">03</span><div><strong>Publikasikan</strong><small>Aktifkan publikasi agar konten ditampilkan di website.</small></div></div>
                    </div>
                </section>
            </div>

            <footer class="adm-bottom-note">Panel Administrasi MI Darul Ulum Gedongan · {{ date('Y') }}</footer>
        </div>
    </main>
</div>
<script>
    (() => {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('adminOverlay');
        const button = document.getElementById('adminMenuButton');
        if (!sidebar || !overlay || !button) return;

        const closeMenu = () => {
            sidebar.classList.remove('is-open');
            overlay.hidden = true;
            button.setAttribute('aria-expanded', 'false');
        };
        button.addEventListener('click', () => {
            const isOpen = sidebar.classList.toggle('is-open');
            overlay.hidden = !isOpen;
            button.setAttribute('aria-expanded', String(isOpen));
        });
        overlay.addEventListener('click', closeMenu);
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') closeMenu();
        });
        window.addEventListener('resize', () => {
            if (window.innerWidth > 940) closeMenu();
        });
    })();
</script>
</body>
</html>
