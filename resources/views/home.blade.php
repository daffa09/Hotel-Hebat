@extends('layouts.main')

@section('container')

    <h1>Hotel Hebat</h1>

<div class="form-pesan mb-5">
            <div class="image-hero mt-4">
                <img src="{{ asset('assets/img/banner.png') }}" width="1310" height="500" class="align-items-center shadow p-3 mb-3 bg-body rounded" alt="Banner Utama">
            </div>

        @if (session()->has('success'))
            <div class="alert alert-success col-lg-5" id="pesan" role="alert">
            {{ session('success') }}
            </div>
        @endif

        @if (session()->has('failed'))
        <div class="alert alert-danger col-lg-5" id="pesan" role="alert">
        {{ session('failed') }}
        </div>
        @endif

    <form action="{{ route('pesanKamar') }}" method="POST" class="d-flex justify-content-center">
        @csrf    
        <div class="form-group m-3">
                <label for="tgl_checkin">Tanggal Checkin</label>
                <input type="date" class="form-control" id="tgl_checkin" name="tgl_checkin" placeholder="Tanggal Checkin" min="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="form-group m-3">
                <label for="tgl_checkout">Tanggal Checkout</label>
                <input type="date" class="form-control" id="tgl_checkout" name="tgl_checkout" placeholder="Tanggal Checkout" min="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="form-group m-3">
                <label for="id_tipe_kamar">Tipe Kamar</label>
                <select class="form-control" name="id_tipe_kamar"> 
                <option selected>Tipe Kamar</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kamar }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group m-3">
                <label for="jml_kamar">Jumlah Kamar</label>
                <input type="number" class="form-control" id="jml_kamar" name="jml_kamar" placeholder="Jumlah Kamar">
            </div>
            <div class="form-group" style="margin: 32px">
                <button type="submit" class="btn btn-primary m-2">Pesan</button>
                <button type="reset" class="btn btn-warning text-white">Reset</button>
            </div>
        </form>

        <h2 class="text-center fs-2">Tentang Kami</h2>
        <p class="text-center m5-5" style="font-size: 1rem">Kami menyediakan pelayanan kamar kualitas terbaik. Melayani tamu 24 jam sesuai dengan kebutuhan tamu. Di lengkapi dengan spa, refleksi, dan sauna terbaik kami. Siap untuk memanjakan anda yang akan berkunjung dan menginap di hotel kami. Harga terjangkau, kualitas terbaik, khusus untuk anda!</p>

@endsection
