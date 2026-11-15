<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\View\View;

class BeritaPublikController extends Controller
{
    public function index(): View
    {
        $rasioFoto = [
            ['16 / 9', '16:9'],
            ['3 / 4', '3:4'],
            ['9 / 16', '9:16'],
            ['3 / 4', '3:4'],
            ['1 / 1', '1:1'],
            ['3 / 4', '3:4'],
            ['16 / 9', '16:9'],
            ['9 / 16', '9:16'],
            ['1 / 1', '1:1'],
        ];

        $berita = Berita::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get()
            ->values()
            ->map(function (Berita $item, int $index) use ($rasioFoto) {
                // Prioritaskan rasio yang dipilih admin saat crop.
                $pilihan = ['16:9', '3:4', '9:16', '1:1'];
                $rasioTersimpan = in_array($item->rasio, $pilihan, true)
                    ? $item->rasio
                    : $rasioFoto[$index % count($rasioFoto)][1];
                $rasio = str_replace(':', ' / ', $rasioTersimpan);
                $labelRasio = $rasioTersimpan;

                return [
                    'id' => $item->id,
                    'kategori' => $item->kategori,
                    'judul' => $item->judul,
                    'deskripsi' => $item->deskripsi,
                    'konten' => $item->konten,
                    'gambar' => $item->gambar ? 'storage/' . ltrim($item->gambar, '/') : null,
                    'rasio' => $rasio,
                    'label_rasio' => $labelRasio,
                    'tanggal' => ($item->published_at ?? $item->created_at)?->format('d/m/Y'),
                ];
            })
            ->all();

        return view('pages.berita', compact('berita'));
    }
}
