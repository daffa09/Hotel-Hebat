@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid bg-light" style="border-radius: 10px">

        @if (session()->has('failed'))
            <div class="alert alert-danger col-lg-5" id="pesan" role="alert">
            {{ session('failed') }}
            </div>
        @endif

        <form class="col-md-8 mt-4 p-2" action="/dashboard/fasilitasKamar" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="mb-3">
            <label for="id_tipe_kamar" class="form-label @error('id_tipe_kamar') is-invalid @enderror">Nama Kamar</label>
            <select class="form-control" name="id_tipe_kamar"> 
                <option selected>Nama Kamar...</option>
            @foreach($kamar as $kmr)
                <option value="{{ old('id_tipe_kamar'), $kmr->id }} {{ ( $kmr->id == $kmr->id) ? $kmr->id : '' }}">{{ $kmr->nama_kamar }}</option>
            @endforeach
            </select>
            @error('id_tipe_kamar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_fasilitas_kamar" class="form-label @error('nama_fasilitas_kamar') is-invalid @enderror">Nama Fasilitas Kamar</label>
            <input type="text" name="nama_fasilitas_kamar" class="form-control" id="nama_fasilitas_kamar" placeholder="Nama Fasilitas Kamar.." value="{{ old('nama_fasilitas_kamar') }}">
            @error('nama_fasilitas_kamar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button class="btn btn-primary mb-3" type="submit" onclick="return confirm('Apakah anda yakin ingin menambah ini?')">Tambah Data</button>
        <a href="/dashboard/fasilitasKamar" class="btn btn-success mb-3">Kembali</a>
        <button type="reset" class="btn btn-warning text-white mb-3">Reset</button>
    
    </form>
</div>
@endsection