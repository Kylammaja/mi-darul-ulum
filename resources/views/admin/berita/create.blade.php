@extends('admin.berita.layout')

@section('title', 'Tambah Berita')

@section('content')
<div class="mb-6">
    <p class="text-xs font-bold uppercase tracking-widest text-secondary">Kelola Berita</p>
    <h1 class="mt-2 font-heading text-3xl font-extrabold">Tambah Berita</h1>
    <p class="mt-2 text-sm text-slate-500">Isi informasi kegiatan atau prestasi sekolah.</p>
</div>
<form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data"
      class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm sm:p-8">
    @csrf
    @include('admin.berita._form', ['submitLabel' => 'Simpan Berita'])
</form>
@endsection
