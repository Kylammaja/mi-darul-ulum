<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\BeritaPublikController;

// Beranda: pertahankan file dan section yang sudah ada.


Route::get('/', function () {

    $beritas = \App\Models\Berita::where('is_published', true)
        ->latest()
        ->take(9)
        ->get();

    return view('welcome', compact('beritas'));

})->name('home');



// Halaman informasi.

Route::get('/informasi/spmb', function () {
    return view('pages.spmb');
})->name('informasi.spmb');



Route::get('/informasi/berita', [
    BeritaPublikController::class,
    'index'
])->name('informasi.berita');



Route::get('/informasi/fasilitas', function () {
    return view('pages.fasilitas');
})->name('informasi.fasilitas');


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

use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\EnsureAdmin;

// LOGIN ADMIN
Route::get('/admin/login', [
    AdminAuthController::class,
    'showLogin'
])->name('login');

Route::post('/admin/login', [
    AdminAuthController::class,
    'login'
])->middleware('throttle:5,1')->name('admin.login.submit');

// HALAMAN KHUSUS ADMIN
Route::middleware(['auth', EnsureAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        Route::post('/logout', [
            AdminAuthController::class,
            'logout'
        ])->name('logout');
    
        Route::resource('berita', BeritaController::class)
    ->parameters(['berita' => 'berita'])
    ->except(['show']);});
