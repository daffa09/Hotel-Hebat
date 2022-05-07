@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex flex-wrap align-items-center mb-3 mt-3 justify-content-center bg-light" style="border-radius: 10px !important; margin-top: 100px !important">
    
    <div class="container" class="" style="margin-top: 200px; margin-bottom: 200px">
        <h1 class="text-center">Selamat Datang Petugas Hotel Hebat</h1>
        <h1 class="text-center">{{ $username }}</h1>
    </div>

@endsection