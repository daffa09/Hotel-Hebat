@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid bg-light" style="border-radius: 10px">
    <div class="tipe mt-5">
    @if ($model->gambar)
        <img src="{{ asset('storage/' . $model->gambar) }}" width="1310" height="400"    class="align-items-center shadow p-3 mb-3 bg-body rounded" alt="Banner Utama">
    @else
        <img class="img-preview img-fluid mb-3 col-sm-3">
    @endif
        <h3> Tipe Kamar : {{ $model->nama_kamar }}</h3>
        <p class="p-3" style="margin-bottom: -30px"> Jumlah Kamar : {{ $model->jumlah_kamar }}</p>
    </div>
    
        <a href="/dashboard/tipeKamar" class="btn btn-success mb-3 mt-5">Kembali</a>
    
    </form>
</div>
@endsection