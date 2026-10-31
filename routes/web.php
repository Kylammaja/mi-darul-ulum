<?php

use Illuminate\Support\Facades\Route;

// Beranda: pertahankan file dan section yang sudah ada.
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman informasi.
Route::view('/informasi/spmb', 'pages.informasi', [
    'label' => 'PENERIMAAN MURID BARU',
    'title' => 'Informasi SPMB',
    'description' => 'Informasi pendaftaran murid baru MI Darul Ulum Gedongan akan disajikan di halaman ini.',
    'topics' => [
        ['title' => 'Jadwal Pendaftaran', 'description' => 'Tanggal dan tahapan pendaftaran akan dicantumkan setelah dikonfirmasi pihak madrasah.'],
        ['title' => 'Persyaratan', 'description' => 'Dokumen dan persyaratan calon murid akan diumumkan melalui halaman ini.'],
        ['title' => 'Alur Pendaftaran', 'description' => 'Informasi tahapan pengisian formulir dan verifikasi akan ditambahkan.'],
    ],
])->name('informasi.spmb');

Route::view('/informasi/berita', 'pages.berita')->name('informasi.berita');

Route::view('/informasi/fasilitas', 'pages.informasi', [
    'label' => 'LINGKUNGAN BELAJAR',
    'title' => 'Fasilitas Madrasah',
    'description' => 'Halaman dokumentasi fasilitas MI Darul Ulum Gedongan.',
    'topics' => [
        ['title' => 'Ruang dan Lingkungan', 'description' => 'Foto dan penjelasan fasilitas sekolah akan ditambahkan berdasarkan data asli.'],
        ['title' => 'Sarana Pembelajaran', 'description' => 'Informasi sarana belajar akan dicantumkan setelah dikonfirmasi.'],
        ['title' => 'Galeri Fasilitas', 'description' => 'Dokumentasi lingkungan dan fasilitas madrasah akan tersedia di sini.'],
    ],
])->name('informasi.fasilitas');

// Halaman profil.
Route::view('/profil', 'pages.informasi', [
    'label' => 'MENGENAL MADRASAH',
    'title' => 'Profil MI Darul Ulum Gedongan',
    'description' => 'Informasi sejarah, identitas, dan kegiatan madrasah akan dilengkapi di halaman ini.',
    'topics' => [
        ['title' => 'Tentang Madrasah', 'description' => 'Sejarah dan informasi resmi sekolah akan ditambahkan.'],
        ['title' => 'Visi dan Misi', 'description' => 'Baca bagian Visi dan Misi pada halaman Beranda.'],
        ['title' => 'Sambutan Kepala Madrasah', 'description' => 'Baca sambutan pada halaman Beranda.'],
    ],
])->name('profil');

Route::view('/profil/struktur-organisasi', 'pages.informasi', [
    'label' => 'ORGANISASI MADRASAH',
    'title' => 'Struktur Organisasi',
    'description' => 'Susunan pengelola madrasah akan ditampilkan setelah memperoleh data nama dan jabatan resmi.',
    'topics' => [
        ['title' => 'Pimpinan Madrasah', 'description' => 'Nama dan foto pimpinan akan ditambahkan setelah dikonfirmasi.'],
        ['title' => 'Pengelola dan Koordinator', 'description' => 'Susunan jabatan dan tanggung jawab akan ditambahkan sesuai struktur resmi.'],
        ['title' => 'Tenaga Pendidik', 'description' => 'Daftar guru dan staf akan ditampilkan apabila datanya sudah tersedia.'],
    ],
])->name('profil.struktur');

// Opsional: URL lama tetap dapat dipakai, diarahkan ke section Beranda.
Route::get('/visi-misi', function () {
    return redirect(route('home') . '#visi-misi');
})->name('visi-misi');

Route::get('/profil/kepala-madrasah', function () {
    return redirect(route('home') . '#kepala-sekolah');
})->name('profil.kepala');

Route::get('/profil/struktur-organisasi', function () {
    return view('pages.struktur-organisasi');
})->name('profil.struktur-organisasi');
