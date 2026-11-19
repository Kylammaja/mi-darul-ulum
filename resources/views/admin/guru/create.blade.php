@extends('admin.guru.layout')
@section('title', 'Tambah Guru')
@section('content')
    <div class="mb-6"><p class="text-xs font-bold uppercase tracking-widest text-[#006B66]">DATA BARU</p><h2 class="mt-2 font-heading text-3xl font-extrabold">Tambah Guru</h2></div>
    <div class="max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9">
        @include('admin.guru._form')
    </div>
@endsection
