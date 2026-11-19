@extends('admin.guru.layout')
@section('title', 'Edit Guru')
@section('content')
    <div class="mb-6"><p class="text-xs font-bold uppercase tracking-widest text-[#006B66]">PERBARUI DATA</p><h2 class="mt-2 font-heading text-3xl font-extrabold">Edit Guru</h2></div>
    <div class="max-w-4xl rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-9">
        @include('admin.guru._form')
    </div>
@endsection
