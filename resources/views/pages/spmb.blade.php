@extends('layouts.inner')

@section('title', 'SPMB - MI Darul Ulum Gedongan')

@section('content')
@php
    // File gambar diletakkan di public/images/spmb/.
    // Judul dan deskripsi bisa disesuaikan dengan isi poster sebenarnya.
    $spmbDocuments = [
        [
            'title' => 'Poster SPMB',
            'label' => 'Informasi utama',
            'description' => 'Poster penerimaan murid baru MI Darul Ulum Gedongan.',
            'file' => 'image.png',
        ],
        [
            'title' => 'Jadwal & Alur',
            'label' => 'Tahapan pendaftaran',
            'description' => 'Lihat informasi jadwal dan alur pendaftaran pada poster sekolah.',
            'file' => '2.png',
        ],
        [
            'title' => 'Informasi SPP',
            'label' => 'Informasi pembayaran',
            'description' => 'Rincian informasi SPP sesuai keterangan yang tertera pada gambar.',
            'file' => 'spp.png',
        ],
    ];

    $spmbDocuments = array_map(static function ($doc) {
        $path = 'images/spmb/' . $doc['file'];
        return array_merge($doc, [
            'url' => asset($path),
            'exists' => is_file(public_path($path)),
        ]);
    }, $spmbDocuments);
@endphp

{{-- Logika Alpine dipisahkan dari atribut HTML agar tidak merusak parsing Blade. --}}
<script>
    window.spmbPortal = function () {
        return {
            documents: @json($spmbDocuments),
            active: 0,
            viewerOpen: false,
            get current() { return this.documents[this.active] || {}; },
            get currentNumber() { return String(this.active + 1).padStart(2, '0'); },
            select(index) {
                if (index >= 0 && index < this.documents.length) this.active = index;
            },
            next() { this.active = (this.active + 1) % this.documents.length; },
            previous() { this.active = (this.active + this.documents.length - 1) % this.documents.length; },
            openViewer() { if (this.current.exists) this.viewerOpen = true; },
            closeViewer() { this.viewerOpen = false; },
        };
    };
</script>

<section id="spmb-portal" x-data="spmbPortal()"
         @keydown.escape.window="closeViewer()"
         @keydown.left.window="if (viewerOpen) previous()"
         @keydown.right.window="if (viewerOpen) next()">

    <div class="spmb-container">
        {{-- Header berpusat dan ringkas, sengaja berbeda dari Hero Beranda. --}}
        <header class="spmb-heading">
            <div class="spmb-kicker"><span class="spmb-kicker-dot"></span> INFORMASI PENDAFTARAN <span class="spmb-kicker-line"></span> MI DARUL ULUM GEDONGAN</div>
            <h1>Jelajahi informasi <span>SPMB.</span></h1>
            <p>Pilih dokumen di bawah untuk melihat poster, jadwal, dan informasi pendaftaran. Klik gambar untuk membaca detail dalam ukuran besar.</p>
        </header>

        {{-- Workspace seperti pembaca dokumen, bukan dua kolom Hero. --}}
        <div class="spmb-workspace" aria-label="Pusat informasi SPMB">
            <aside class="spmb-sidebar" aria-label="Daftar dokumen SPMB">
                <div class="spmb-sidebar-top">
                    <div>
                        <span class="spmb-small-label">PUSAT INFORMASI</span>
                        <h2>Dokumen SPMB</h2>
                    </div>
                    <span class="spmb-file-count">{{ count($spmbDocuments) }} FILE</span>
                </div>

                <nav class="spmb-doc-list" aria-label="Pilih informasi">
                    <template x-for="(doc, index) in documents" :key="doc.file">
                        <button type="button"
                                class="spmb-doc-option"
                                :class="{ 'is-active': active === index }"
                                :aria-pressed="active === index ? 'true' : 'false'"
                                @click="select(index)">
                            <span class="spmb-option-number" x-text="String(index + 1).padStart(2, '0')"></span>
                            <span class="spmb-option-copy">
                                <strong x-text="doc.title"></strong>
                                <small x-text="doc.label"></small>
                            </span>
                            <svg class="spmb-option-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    </template>
                </nav>

                <div class="spmb-sidebar-note">
                    <span class="spmb-note-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 11v5m0-8h.01" stroke-linecap="round"/></svg>
                    </span>
                    <div>
                        <strong>Perhatikan informasi resmi</strong>
                        <p>Jadwal, persyaratan, dan biaya mengikuti keterangan pada poster madrasah.</p>
                    </div>
                </div>
            </aside>

            <div class="spmb-reader">
                <div class="spmb-reader-toolbar">
                    <div class="spmb-reader-location">
                        <span class="spmb-reader-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 3h6l5 5v12a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2Z"/><path d="M14 3v6h5M8 13h8M8 17h6"/></svg>
                        </span>
                        <div>
                            <span class="spmb-small-label">PRATINJAU DOKUMEN</span>
                            <h3 x-text="current.title">Poster SPMB</h3>
                        </div>
                    </div>
                    <span class="spmb-page-number"><span x-text="currentNumber">01</span> / {{ sprintf('%02d', count($spmbDocuments)) }}</span>
                </div>

                <div class="spmb-reader-stage">
                    <div class="spmb-stage-grid" aria-hidden="true"></div>
                    <div class="spmb-stage-tag"><span></span> DOKUMEN SEKOLAH</div>

                    <button type="button" class="spmb-poster-button" @click="openViewer()"
                            :disabled="!current.exists"
                            :aria-label="'Perbesar ' + current.title">
                        <template x-for="(doc, index) in documents" :key="doc.file">
                            <img x-show="active === index && doc.exists"
                                 x-transition.opacity.duration.250ms
                                 :src="doc.url" :alt="doc.title"
                                 loading="lazy" draggable="false" />
                        </template>
                        <span x-show="!current.exists" class="spmb-missing-image">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8" cy="8" r="1.2"/><path d="m3 17 6-6 4 4 3-3 5 5"/></svg>
                            <span>Poster belum tersedia</span>
                        </span>
                        <span x-show="current.exists" class="spmb-poster-zoom">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 4h8v8M20 4l-9 9"/><path d="M20 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h5"/></svg>
                            Perbesar poster
                        </span>
                    </button>
                </div>

                <div class="spmb-reader-footer">
                    <div class="spmb-doc-description" aria-live="polite">
                        <span class="spmb-small-label" x-text="current.label">Informasi utama</span>
                        <p x-text="current.description">Informasi penerimaan murid baru.</p>
                    </div>
                    <div class="spmb-reader-actions">
                        <button class="spmb-nav-button" type="button" @click="previous()" aria-label="Dokumen sebelumnya">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <button class="spmb-nav-button" type="button" @click="next()" aria-label="Dokumen berikutnya">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                        <button class="spmb-detail-button" type="button" @click="openViewer()" :disabled="!current.exists">
                            Lihat detail
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="spmb-footnote">
            <span>MI DARUL ULUM GEDONGAN</span>
            <span>Portal Informasi Penerimaan Murid Baru</span>
        </div>
    </div>

    {{-- Viewer fullscreen: poster tidak di-crop, dapat dibaca dengan ukuran besar. --}}
    <div x-cloak x-show="viewerOpen" x-transition.opacity.duration.200ms
         class="spmb-lightbox" role="dialog" aria-modal="true" aria-label="Detail poster SPMB"
         @click.self="closeViewer()">
        <div class="spmb-lightbox-head">
            <div>
                <span>INFORMASI SPMB</span>
                <strong x-text="current.title">Poster SPMB</strong>
            </div>
            <button type="button" @click="closeViewer()" aria-label="Tutup gambar">&times;</button>
        </div>
        <div class="spmb-lightbox-body" @click.self="closeViewer()">
            <img :src="current.url" :alt="current.title" />
        </div>
        <div class="spmb-lightbox-bottom">
            <span>Tekan Esc untuk menutup • ← → untuk berpindah poster</span>
            <a :href="current.url" target="_blank" rel="noopener noreferrer">Buka gambar asli ↗</a>
        </div>
    </div>
</section>

<style>
    #spmb-portal { --spmb-dark:#003844; --spmb-accent:#006B66; --spmb-muted:#6A7D84; background:#F7FAF9; color:var(--spmb-dark); min-height:100vh; padding:144px 0 80px; font-family:'Plus Jakarta Sans',system-ui,sans-serif; }
    #spmb-portal *, #spmb-portal *::before, #spmb-portal *::after { box-sizing:border-box; }
    #spmb-portal [x-cloak] { display:none !important; }
    #spmb-portal button, #spmb-portal a { -webkit-tap-highlight-color:transparent; }
    #spmb-portal button:focus-visible, #spmb-portal a:focus-visible { outline:3px solid #3FABA4; outline-offset:3px; }
    #spmb-portal .spmb-container { max-width:1240px; padding:0 28px; margin:0 auto; }
    #spmb-portal .spmb-heading { max-width:760px; margin:0 auto 46px; text-align:center; }
    #spmb-portal .spmb-kicker { display:flex; justify-content:center; align-items:center; gap:12px; flex-wrap:wrap; font-size:10px; letter-spacing:.13em; font-weight:800; color:var(--spmb-accent); }
    #spmb-portal .spmb-kicker-dot { width:7px; height:7px; background:var(--spmb-accent); border-radius:50%; box-shadow:0 0 0 5px rgba(0,107,102,.10); }
    #spmb-portal .spmb-kicker-line { height:1px; width:23px; background:#BCD5D0; }
    #spmb-portal .spmb-heading h1 { font-size:clamp(31px,4vw,48px); font-weight:800; letter-spacing:-.05em; line-height:1.2; margin:19px 0 0; }
    #spmb-portal .spmb-heading h1 span { color:var(--spmb-accent); }
    #spmb-portal .spmb-heading p { font-size:14px; color:#607881; line-height:1.9; margin:17px auto 0; max-width:620px; }
    #spmb-portal .spmb-workspace { display:grid; grid-template-columns:300px minmax(0,1fr); align-items:stretch; border:1px solid #DCE8E5; border-radius:22px; overflow:hidden; background:white; box-shadow:0 24px 65px -48px rgba(0,56,68,.30); }
    #spmb-portal .spmb-sidebar { min-width:0; padding:29px 20px; border-right:1px solid #E0EBE8; display:flex; flex-direction:column; background:#fff; }
    #spmb-portal .spmb-sidebar-top { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:0 9px 22px; border-bottom:1px solid #EDF3F1; }
    #spmb-portal .spmb-small-label { display:block; font-size:10px; font-weight:800; letter-spacing:.11em; color:var(--spmb-accent); line-height:1.4; }
    #spmb-portal .spmb-sidebar-top h2 { font-size:18px; font-weight:800; letter-spacing:-.03em; margin:7px 0 0; }
    #spmb-portal .spmb-file-count { flex:none; border-radius:30px; background:#E8F2EF; color:#0A706A; padding:8px 10px; font-size:10px; font-weight:800; white-space:nowrap; }
    #spmb-portal .spmb-doc-list { padding-top:18px; display:grid; gap:8px; }
    #spmb-portal .spmb-doc-option { appearance:none; border:1px solid transparent; background:transparent; color:var(--spmb-dark); text-align:left; width:100%; padding:15px 13px; border-radius:13px; display:flex; align-items:center; gap:13px; cursor:pointer; transition:background .22s,border-color .22s,transform .22s; font-family:inherit; }
    #spmb-portal .spmb-doc-option:hover { background:#F0F7F4; }
    #spmb-portal .spmb-doc-option.is-active { background:#E8F4F0; border-color:#C7E2D9; }
    #spmb-portal .spmb-option-number { color:#83A4A1; font-size:12px; font-weight:800; font-variant-numeric:tabular-nums; }
    #spmb-portal .spmb-doc-option.is-active .spmb-option-number { color:var(--spmb-accent); }
    #spmb-portal .spmb-option-copy { flex:1; min-width:0; }
    #spmb-portal .spmb-option-copy strong { display:block; font-size:13px; font-weight:800; line-height:1.5; }
    #spmb-portal .spmb-option-copy small { display:block; font-size:11px; color:#748A90; line-height:1.5; margin-top:4px; }
    #spmb-portal .spmb-option-arrow { width:16px; height:16px; color:#8EA8A5; flex:none; }
    #spmb-portal .spmb-doc-option.is-active .spmb-option-arrow { color:var(--spmb-accent); }
    #spmb-portal .spmb-sidebar-note { margin-top:auto; padding:24px 11px 0; display:flex; gap:12px; border-top:1px solid #EDF3F1; }
    #spmb-portal .spmb-note-icon { flex:none; display:grid; place-items:center; width:33px; height:33px; border-radius:10px; background:#EDF5F2; color:var(--spmb-accent); }
    #spmb-portal .spmb-note-icon svg { width:18px; height:18px; }
    #spmb-portal .spmb-sidebar-note strong { font-size:12px; line-height:1.5; }
    #spmb-portal .spmb-sidebar-note p { margin:6px 0 0; color:#829498; font-size:11px; line-height:1.8; }
    #spmb-portal .spmb-reader { min-width:0; display:flex; flex-direction:column; }
    #spmb-portal .spmb-reader-toolbar { min-height:83px; display:flex; align-items:center; justify-content:space-between; padding:19px 29px; gap:16px; border-bottom:1px solid #E6EFEC; }
    #spmb-portal .spmb-reader-location { display:flex; align-items:center; gap:12px; min-width:0; }
    #spmb-portal .spmb-reader-icon { display:grid; place-items:center; width:39px; height:39px; flex:none; background:#EAF3F0; color:var(--spmb-accent); border-radius:11px; }
    #spmb-portal .spmb-reader-icon svg { width:20px; height:20px; }
    #spmb-portal .spmb-reader-location h3 { font-weight:800; font-size:16px; line-height:1.4; letter-spacing:-.02em; margin:3px 0 0; }
    #spmb-portal .spmb-page-number { font-variant-numeric:tabular-nums; color:#7F9598; font-size:12px; letter-spacing:.10em; font-weight:800; white-space:nowrap; }
    #spmb-portal .spmb-reader-stage { min-height:560px; position:relative; display:flex; align-items:center; justify-content:center; padding:35px; background:radial-gradient(circle at 50% 35%,rgba(255,255,255,.95),transparent 55%),linear-gradient(140deg,#E9F2EE 0%,#F5F7F4 56%,#E5EFEE 100%); isolation:isolate; overflow:hidden; }
    #spmb-portal .spmb-stage-grid { position:absolute; inset:0; z-index:-1; opacity:.6; background-image:radial-gradient(#C8DDD6 0.8px,transparent 0.8px); background-size:22px 22px; mask-image:linear-gradient(90deg,transparent,#000 35%,#000 65%,transparent); pointer-events:none; }
    #spmb-portal .spmb-stage-tag { position:absolute; top:25px; left:29px; display:flex; align-items:center; gap:8px; font-size:10px; letter-spacing:.12em; font-weight:800; color:#648980; }
    #spmb-portal .spmb-stage-tag span { width:7px; height:7px; border-radius:50%; background:#0C8B7B; }
    #spmb-portal .spmb-poster-button { position:relative; display:flex; align-items:center; justify-content:center; cursor:zoom-in; width:min(100%,470px); min-height:360px; max-height:505px; background:transparent; padding:0; border:0; font-family:inherit; transition:transform .3s ease; }
    #spmb-portal .spmb-poster-button:hover { transform:translateY(-4px); }
    #spmb-portal .spmb-poster-button:disabled { cursor:default; }
    #spmb-portal .spmb-poster-button img { display:block; width:auto; height:auto; max-width:100%; max-height:505px; object-fit:contain; border:8px solid #FFFFFF; border-radius:7px; box-shadow:0 22px 45px -24px rgba(0,56,68,.38),0 3px 16px rgba(0,56,68,.1); }
    #spmb-portal .spmb-poster-zoom { position:absolute; bottom:15px; left:50%; transform:translateX(-50%); border-radius:50px; background:rgba(0,56,68,.9); color:#fff; display:flex; align-items:center; gap:8px; padding:11px 16px; white-space:nowrap; font-size:11px; font-weight:800; box-shadow:0 8px 22px rgba(0,56,68,.25); opacity:0; transition:opacity .2s; pointer-events:none; }
    #spmb-portal .spmb-poster-zoom svg { width:15px; height:15px; }
    #spmb-portal .spmb-poster-button:hover .spmb-poster-zoom, #spmb-portal .spmb-poster-button:focus-visible .spmb-poster-zoom { opacity:1; }
    #spmb-portal .spmb-missing-image { min-height:320px; min-width:min(100%,290px); display:flex; flex-direction:column; justify-content:center; align-items:center; gap:12px; border-radius:14px; background:rgba(255,255,255,.7); color:#849C9C; font-size:13px; }
    #spmb-portal .spmb-missing-image svg { height:35px; width:35px; }
    #spmb-portal .spmb-reader-footer { display:flex; align-items:center; justify-content:space-between; gap:22px; padding:21px 27px; background:#fff; }
    #spmb-portal .spmb-doc-description { max-width:385px; }
    #spmb-portal .spmb-doc-description p { color:#607982; font-size:12px; line-height:1.7; margin:6px 0 0; }
    #spmb-portal .spmb-reader-actions { display:flex; align-items:center; gap:9px; flex:none; }
    #spmb-portal .spmb-nav-button { width:38px; height:38px; border-radius:50%; display:grid; place-items:center; border:1px solid #DAE8E3; background:white; color:var(--spmb-dark); cursor:pointer; transition:background .2s,border-color .2s; }
    #spmb-portal .spmb-nav-button:hover { background:#E8F4F0; border-color:#BCDAD2; }
    #spmb-portal .spmb-nav-button svg { width:17px; height:17px; }
    #spmb-portal .spmb-detail-button { border:0; border-radius:10px; background:var(--spmb-accent); color:white; padding:12px 15px; display:flex; align-items:center; gap:12px; font:inherit; font-size:12px; font-weight:800; cursor:pointer; transition:background .2s,transform .2s; white-space:nowrap; }
    #spmb-portal .spmb-detail-button:hover { background:var(--spmb-dark); transform:translateY(-2px); }
    #spmb-portal .spmb-detail-button:disabled { opacity:.5; cursor:default; }
    #spmb-portal .spmb-detail-button svg { height:16px; width:16px; }
    #spmb-portal .spmb-footnote { display:flex; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-top:21px; color:#91A6A7; font-size:10px; font-weight:700; letter-spacing:.08em; }
    #spmb-portal .spmb-lightbox { position:fixed; inset:0; z-index:9999; display:flex; flex-direction:column; padding:16px 25px; background:rgba(0,31,38,.96); backdrop-filter:blur(12px); color:#fff; }
    #spmb-portal .spmb-lightbox-head { display:flex; justify-content:space-between; align-items:center; gap:15px; max-width:1360px; width:100%; margin:0 auto; }
    #spmb-portal .spmb-lightbox-head span { display:block; color:#9BC8C2; font-size:10px; letter-spacing:.16em; font-weight:700; }
    #spmb-portal .spmb-lightbox-head strong { display:block; margin-top:4px; font-size:17px; }
    #spmb-portal .spmb-lightbox-head button { flex:none; display:grid; place-items:center; width:42px; height:42px; border-radius:50%; background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); color:#fff; font-size:27px; cursor:pointer; }
    #spmb-portal .spmb-lightbox-body { flex:1; min-height:0; display:flex; align-items:center; justify-content:center; padding:14px 0; }
    #spmb-portal .spmb-lightbox-body img { max-width:100%; max-height:100%; object-fit:contain; border-radius:4px; box-shadow:0 16px 80px rgba(0,0,0,.35); }
    #spmb-portal .spmb-lightbox-bottom { max-width:1360px; width:100%; margin:0 auto; display:flex; justify-content:space-between; align-items:center; gap:15px; color:#A7C5C5; font-size:11px; }
    #spmb-portal .spmb-lightbox-bottom a { display:inline-flex; justify-content:center; padding:11px 15px; text-decoration:none; white-space:nowrap; color:#003844; background:#fff; border-radius:30px; font-size:11px; font-weight:800; }
    @media(max-width:920px) {
        #spmb-portal .spmb-workspace { grid-template-columns:245px minmax(0,1fr); }
        #spmb-portal .spmb-sidebar { padding:23px 13px; }
        #spmb-portal .spmb-reader-stage { min-height:480px; }
        #spmb-portal .spmb-reader-footer { align-items:flex-start; flex-direction:column; }
        #spmb-portal .spmb-sidebar-note { padding:20px 8px 0; }
    }
    @media(max-width:690px) {
        #spmb-portal { padding:115px 0 58px; }
        #spmb-portal .spmb-container { padding:0 17px; }
        #spmb-portal .spmb-heading { margin-bottom:29px; }
        #spmb-portal .spmb-heading h1 { font-size:32px; }
        #spmb-portal .spmb-heading p { font-size:12px; line-height:1.8; }
        #spmb-portal .spmb-kicker { font-size:9px; gap:9px; }
        #spmb-portal .spmb-workspace { grid-template-columns:minmax(0,1fr); border-radius:17px; }
        #spmb-portal .spmb-sidebar { border-right:0; border-bottom:1px solid #E0EBE8; padding:18px 14px 15px; }
        #spmb-portal .spmb-sidebar-top { padding:0 3px 13px; }
        #spmb-portal .spmb-sidebar-top h2 { font-size:16px; }
        #spmb-portal .spmb-doc-list { display:flex; overflow-x:auto; gap:8px; padding:12px 1px 3px; scrollbar-width:thin; }
        #spmb-portal .spmb-doc-option { min-width:185px; max-width:210px; padding:11px 10px; flex:none; }
        #spmb-portal .spmb-option-arrow { display:none; }
        #spmb-portal .spmb-option-copy strong { font-size:12px; }
        #spmb-portal .spmb-option-copy small { font-size:10px; }
        #spmb-portal .spmb-sidebar-note { display:none; }
        #spmb-portal .spmb-reader-toolbar { min-height:71px; padding:15px; }
        #spmb-portal .spmb-reader-stage { min-height:440px; padding:48px 17px 25px; }
        #spmb-portal .spmb-stage-tag { left:16px; top:17px; font-size:9px; }
        #spmb-portal .spmb-poster-button { max-width:100%; max-height:370px; min-height:250px; }
        #spmb-portal .spmb-poster-button img { max-height:370px; }
        #spmb-portal .spmb-poster-zoom { opacity:1; bottom:8px; }
        #spmb-portal .spmb-reader-footer { padding:18px 16px; }
        #spmb-portal .spmb-reader-actions { flex-wrap:wrap; width:100%; }
        #spmb-portal .spmb-detail-button { flex:1; justify-content:center; }
        #spmb-portal .spmb-footnote { font-size:9px; }
        #spmb-portal .spmb-lightbox { padding:12px; }
        #spmb-portal .spmb-lightbox-bottom { align-items:flex-start; flex-direction:column; }
        #spmb-portal .spmb-lightbox-body { padding:15px 0; }
    }
    @media(prefers-reduced-motion:reduce) {
        #spmb-portal *, #spmb-portal *::before, #spmb-portal *::after { transition:none!important; animation:none!important; }
    }
</style>
@endsection
