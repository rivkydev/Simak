@extends('layouts.app')

@section('title', 'Surat Kuasa Ahli Waris')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('admin.pelayanan') }}" class="flex items-center text-bold hover:text-blue-600 mb-6">
            <span class="material-symbols-outlined mr-1">arrow_back</span> Kembali
        </a>
    <h1 class="text-2xl sm:text-3xl font-bold text-[#0A142F] mb-8 shadow-sm">Surat Kuasa Ahli Waris</h1>
</div>
@endsection
