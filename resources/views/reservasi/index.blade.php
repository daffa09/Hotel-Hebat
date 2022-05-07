@extends('layouts.main')

@section('container')

<div class="container-fluid bg-light" style="border-radius: 10px">

    @if (session()->has('failed'))
    <div class="alert alert-danger col-lg-5" id="pesan" role="alert">
        {{ session('failed') }}
    </div>
    @endif

    <div class="image-hero mt-4" style="margin-left: 50px">
        <img src="{{ asset('assets/img/banner.png') }}" width="1200" height="500"
            class="align-items-center shadow p-3 mb-3 bg-body rounded" alt="Banner Utama">
    </div>

    <div class="d-flex justify-content-center">

        <form class="d-flex justify-content-center" action="{{ url('/pemesanan/reservasi') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-group m-3">
                <label for="tgl_checkin">Tanggal Checkin</label>
                <input type="date" class="form-control" id="tgl_checkin" name="tgl_checkin"
                    placeholder="Tanggal Checkin" required min="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="form-group m-3">
                <label for="tgl_checkout">Tanggal Checkout</label>
                <input type="date" class="form-control" id="tgl_checkout" name="tgl_checkout"
                    placeholder="Tanggal Checkout" required min="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="form-group mt-2 m-3">
                <label for="id_tipe_kamar">Tipe Kamar</label>
                <select class="form-control" name="id_tipe_kamar">
                    <option selected>Tipe Kamar</option>
                    @foreach($kamar as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kamar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-3" style="margin: 32px">
                <label for="jml_kamar">Jumlah Kamar</label>
                <input type="number" class="form-control" id="jml_kamar" name="jml_kamar" placeholder="Jumlah Kamar"
                    required>
            </div>
    </div>

    <div class="mb-3" style="border: 1px solid black"></div>

    <div class="row">
        <div class="col-md-12 pb-3">
            <h3>Form Reservasi</h3>
        </div>


        <div class="col-md-10 text-start py-3">
            <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control" id="nama_pemesan" placeholder="Nama Pemesan"
                required>
        </div>
        <div class="col-md-10 text-start py-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
        </div>
        <div class="col-md-10 text-start py-3">
            <label for="no_tlp" class="form-label">No. Tlp</label>
            <input type="number" name="no_tlp" class="form-control" id="no_tlp" placeholder="No. Tlp" required>
        </div>
        <div class="col-md-10 text-start py-3">
            <label for="nama_tamu" class="form-label">Nama Tamu</label>
            <input type="text" name="nama_tamu" class="form-control" id="nama_tamu" placeholder="Nama Tamu" required>
        </div>
        <div class="col-md-10 text-start py-3 text-center">
            <button type="submit" class="btn btn-primary mt-2 col-md-12">konfirmasi Pemesanan</button>
            <a href="/" class="btn btn-success mt-2 col-md-12 mb-5">Kembali</a>
        </div>
    </div>
    </form>

</div>

@endsection