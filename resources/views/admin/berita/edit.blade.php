@extends('admin.berita.layout')

@section('title', 'Edit Berita')

@section('content')
<div class="mb-6">
    <p class="text-xs font-bold uppercase tracking-widest text-secondary">Kelola Berita</p>
    <h1 class="mt-2 font-heading text-3xl font-extrabold">Edit Berita</h1>
    <p class="mt-2 text-sm text-slate-500">Perbarui berita “{{ $berita->judul }}”.</p>
</div>
<form method="POST" action="{{ route('admin.berita.update', $berita) }}" enctype="multipart/form-data"
      class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm sm:p-8">
    @csrf
    @method('PUT')
    @include('admin.berita._form', ['submitLabel' => 'Simpan Perubahan'])
</form>
@endsection
