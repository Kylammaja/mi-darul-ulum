@if ($errors->any())
    <div role="alert" class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
        <p class="font-bold">Periksa data berikut:</p>
        <ul class="mt-2 list-inside list-disc">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="grid gap-6 lg:grid-cols-2">
    <div>
        <label for="judul" class="mb-2 block text-sm font-bold">Judul Berita <span class="text-red-600">*</span></label>
        <input id="judul" name="judul" type="text" required maxlength="255"
               value="{{ old('judul', $berita->judul ?? '') }}"
               class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-secondary"
               placeholder="Contoh: Prestasi Siswa MI Darul Ulum">
    </div>
    <div>
        <label for="kategori" class="mb-2 block text-sm font-bold">Kategori <span class="text-red-600">*</span></label>
        <select id="kategori" name="kategori" required class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-secondary">
            <option value="">Pilih kategori</option>
            @foreach ($kategori as $item)
                <option value="{{ $item }}" @selected(old('kategori', $berita->kategori ?? '') === $item)>{{ $item }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mt-6">
    <label for="deskripsi" class="mb-2 block text-sm font-bold">Deskripsi Singkat <span class="text-red-600">*</span></label>
    <textarea id="deskripsi" name="deskripsi" required rows="3" maxlength="1000"
              class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-secondary"
              placeholder="Ringkasan berita untuk kartu di website">{{ old('deskripsi', $berita->deskripsi ?? '') }}</textarea>
</div>

<div class="mt-6">
    <label for="konten" class="mb-2 block text-sm font-bold">Isi Berita</label>
    <textarea id="konten" name="konten" rows="7"
              class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-secondary"
              placeholder="Ceritakan kegiatan atau prestasi secara lengkap...">{{ old('konten', $berita->konten ?? '') }}</textarea>
</div>

<div class="mt-6 grid items-start gap-6 md:grid-cols-2">
{{-- PHOTO UPLOAD WITH CROP PREVIEW --}}
<div id="berita-photo-editor" class="min-w-0">
    <label for="gambar" class="mb-2 block text-sm font-bold">Foto Berita (opsional)</label>
    <p class="mb-3 text-xs leading-5 text-slate-500">
        Pilih foto, atur potongan dan rasio, lalu klik <strong>Gunakan Foto</strong>.
        Hasil disimpan sebagai JPG berkualitas baik, maksimal 2 MB.
    </p>

    {{-- Input 'gambar' tetap sama agar cocok dengan BeritaController yang ada. --}}
    <input
        id="gambar"
        name="gambar"
        type="file"
        accept="image/jpeg,image/png,image/webp"
        class="block w-full min-w-0 rounded-xl border border-slate-200 bg-white px-3 py-3 text-sm
               file:mr-3 file:rounded-full file:border-0 file:bg-secondary/10
               file:px-3 file:py-2 file:font-semibold file:text-secondary"
    >
    <input
        id="rasio"
        type="hidden"
        name="rasio"
        value="{{ old('rasio', $berita->rasio ?? '16:9') }}"
    >

    <div class="mt-3 rounded-2xl border border-secondary/10 bg-[#F4F9F7] p-4">
        <p class="text-xs font-bold text-primary">Pratinjau hasil foto</p>
        <div id="photo-preview-box" class="mt-3 hidden overflow-hidden rounded-xl bg-white">
            <img id="photo-preview" alt="Pratinjau foto berita" class="mx-auto max-h-52 max-w-full object-contain">
        </div>
        <p id="photo-crop-status" role="status" aria-live="polite" class="mt-2 text-xs leading-5 text-slate-600">
            @if (isset($berita) && $berita->gambar)
                Foto saat ini tetap digunakan jika tidak memilih foto baru. Rasio: {{ $berita->rasio ?? '16:9' }}.
            @else
                Belum ada foto yang dipilih.
            @endif
        </p>
        <button id="reopen-crop" type="button" class="mt-3 hidden rounded-full border border-secondary px-4 py-2 text-xs font-bold text-secondary hover:bg-secondary/10">
            Atur ulang crop
        </button>
    </div>

    @if (isset($berita) && $berita->gambar)
        <img
            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($berita->gambar) }}"
            alt="Foto berita saat ini"
            class="mt-4 max-h-40 w-full max-w-sm rounded-xl object-contain"
        >
    @endif

    {{-- Modal editor crop --}}
    <div id="photo-crop-modal" class="fixed inset-0 z-[200] hidden items-center justify-center bg-[#003844]/85 p-3 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="photo-crop-title" aria-hidden="true">
        <div class="flex max-h-[92dvh] w-full max-w-4xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="flex items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
                <div>
                    <h2 id="photo-crop-title" class="font-heading text-lg font-extrabold text-primary">Potong Foto Berita</h2>
                    <p class="mt-1 text-xs text-slate-500">Geser gambar, zoom, lalu pilih rasio sesuai kebutuhan.</p>
                </div>
                <button type="button" id="close-crop" class="rounded-full bg-slate-100 px-3 py-2 text-sm font-bold text-primary" aria-label="Batal dan tutup editor">✕</button>
            </div>

            <div class="h-[42dvh] min-h-[200px] max-h-[430px] overflow-hidden bg-[#EAF1EF] sm:min-h-[300px]">
                <img id="crop-source" alt="Foto yang akan dipotong" class="block max-w-full">
            </div>

            <div class="border-t border-slate-100 bg-white px-5 py-4">
                <p class="mb-3 text-xs font-bold text-primary">Pilih Rasio Foto</p>
                <div class="grid grid-cols-4 gap-2" role="group" aria-label="Rasio hasil crop">
                    @foreach (['16:9', '3:4', '9:16', '1:1'] as $ratio)
                        <button
                            type="button"
                            data-crop-ratio="{{ $ratio }}"
                            aria-pressed="false"
                            class="rounded-xl border border-slate-200 px-2 py-3 text-xs font-bold text-primary transition hover:border-secondary hover:text-secondary sm:text-sm"
                        >{{ $ratio }}</button>
                    @endforeach
                </div>
                <p class="mt-3 text-xs text-slate-500">Output JPG sampai sekitar 1280 px (menyesuaikan rasio dan ukuran sumber).</p>
                <div class="mt-5 flex flex-wrap justify-end gap-3">
                    <button type="button" id="cancel-crop" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-bold text-primary hover:bg-slate-50">Batal</button>
                    <button type="button" id="apply-crop" class="rounded-full bg-secondary px-6 py-3 text-sm font-bold text-white transition hover:bg-primary">Gunakan Foto</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="rounded-2xl bg-[#F4F9F7] p-5">
        <p class="text-sm font-bold">Status Publikasi</p>
        <p class="mt-1 text-xs leading-5 text-slate-500">Draft hanya terlihat di dashboard. Berita terbit nantinya ditampilkan di website.</p>
        <input type="hidden" name="is_published" value="0">
        <label class="mt-5 inline-flex cursor-pointer items-center gap-3 text-sm font-semibold">
            <input type="checkbox" name="is_published" value="1"
                   @checked((bool) old('is_published', $berita->is_published ?? false))
                   class="h-5 w-5 accent-[#006B66]">
            Publikasikan berita
        </label>
    </div>
</div>

<div class="mt-8 flex flex-wrap items-center gap-3">
    <button type="submit" class="rounded-full bg-secondary px-7 py-3.5 text-sm font-bold text-white transition hover:bg-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.berita.index') }}" class="rounded-full border border-slate-200 px-7 py-3.5 text-sm font-bold text-primary hover:bg-slate-50">Batal</a>
</div>
