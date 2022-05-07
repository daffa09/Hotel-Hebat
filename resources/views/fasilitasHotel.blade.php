@extends('layouts.main')

@section('container')

<h1 class="mb-5">Fasilitas Hotel</h1>

<div class="tipe mt-4">
    <img src="{{ asset('assets/img/banner.png') }}" width="1310" height="400"    class="align-items-center shadow p-3 mb-3 bg-body rounded" alt="Banner Utama">
</div>

<div class="container">
    <div class="row">

        @foreach ($fasilitasHotel as $fasilitas)   
        <div class="card mb-5 mt-3" style="width: 12rem; margin-left:20px;">
            <img src="{{ asset('/storage/'.$fasilitas->gambar) }}" class="card-img-top p-2 rounded">
                <div class="card-body">
                    <p class="card-text text-center">{{ $fasilitas->nama_fasilitas_hotel }}</p>
                </div>
        </div>         
        @endforeach
    </div>
</div>

@endsection
