<form action="{{ isset($guru) ? route('admin.struktur-organisasi.update', $guru) : route('admin.struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-7">
    @csrf
    @isset($guru)
        @method('PUT')
    @endisset

    <div class="grid gap-6 md:grid-cols-2">
        <div class="space-y-2">
            <label for="nama" class="block text-sm font-bold">Nama Lengkap <span class="text-red-600">*</span></label>
            <input id="nama" name="nama" type="text" required maxlength="150" value="{{ old('nama', $guru->nama ?? '') }}" placeholder="Nama guru" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-[#006B66] focus:ring-2 focus:ring-[#006B66]/10">
            @error('nama')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="space-y-2">
            <label for="jabatan" class="block text-sm font-bold">Jabatan <span class="text-red-600">*</span></label>
            <input id="jabatan" name="jabatan" type="text" required maxlength="150" value="{{ old('jabatan', $guru->jabatan ?? '') }}" placeholder="Contoh: Kepala Madrasah" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-[#006B66] focus:ring-2 focus:ring-[#006B66]/10">
            @error('jabatan')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="space-y-2">
            <label for="urutan" class="block text-sm font-bold">Urutan Tampil <span class="text-red-600">*</span></label>
            <input id="urutan" name="urutan" type="number" min="0" max="9999" required value="{{ old('urutan', $guru->urutan ?? 1) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 outline-none focus:border-[#006B66] focus:ring-2 focus:ring-[#006B66]/10">
            <p class="text-xs text-slate-500">Angka kecil ditampilkan lebih dulu (contoh: Kepala Madrasah = 1).</p>
        </div>
        <div class="space-y-2">
            <label for="foto" class="block text-sm font-bold">Foto Guru</label>
            <input id="foto" name="foto" type="file" accept="image/jpeg,image/png,image/webp" class="block w-full rounded-xl border border-slate-200 bg-white p-3 text-sm file:mr-4 file:rounded-full file:border-0 file:bg-[#006B66]/10 file:px-4 file:py-2 file:font-semibold file:text-[#006B66]">
            <p class="text-xs text-slate-500">PNG transparan disarankan agar cocok dengan desain kartu. Maksimal 2 MB.</p>
            @error('foto')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    @isset($guru)
        @if ($guru->foto)
            <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-[#F6F9F8] p-4">
                <img src="{{ asset('storage/' . $guru->foto) }}" class="h-28 w-24 rounded-xl bg-white object-contain" alt="Foto saat ini">
                <div><p class="text-sm font-bold">Foto tersimpan</p><p class="mt-1 text-xs text-slate-500">Jika tidak memilih foto baru, foto ini tetap dipakai.</p></div>
            </div>
        @endif
    @endisset

    <label class="flex cursor-pointer items-center gap-3 rounded-2xl bg-[#F6F9F8] p-4 text-sm font-semibold">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($guru) ? (int) $guru->is_active : 1) ? 'checked' : '' }} class="h-5 w-5 rounded border-slate-300 text-[#006B66] focus:ring-[#006B66]">
        Tampilkan guru ini di website (Aktif)
    </label>

    <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 pt-6">
        <button type="submit" class="rounded-full bg-[#006B66] px-7 py-3 text-sm font-bold text-white transition hover:bg-[#003844]">{{ isset($guru) ? 'Simpan Perubahan' : 'Simpan Guru' }}</button>
        <a href="{{ route('admin.struktur-organisasi.index') }}" class="rounded-full border border-slate-200 px-7 py-3 text-sm font-bold hover:bg-slate-50">Batal</a>
    </div>
</form>
