@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid bg-light" style="border-radius: 10px">

    <form class="col-md-8 mt-4 p-2" action="/dashboard/tipeKamar/{{ $model->id }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
            <div class="mb-3">
            <label for="nama_kamar" class="form-label @error('nama_kamar') is-invalid @enderror">Nama Kamar</label>
            <input type="text" name="nama_kamar" id="nama_kamar" class="form-control" placeholder="Nama kamar.." required value="{{ old('nama_kamar', $model->nama_kamar) }}">
            @error('nama_kamar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jumlah_kamar" class="form-label @error('jumlah_kamar') is-invalid @enderror">Jumlah Kamar</label>
            <input type="text" name="jumlah_kamar" id="jumlah_kamar" class="form-control" placeholder="Jumlah kamar.." required value="{{ old('jumlah_kamar', $model->jumlah_kamar) }}">
            @error('jumlah_kamar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label ">Gambar Kamar</label>
            <input type="hidden" name="oldgambar" value="{{ $model->gambar }}">
            @if ($model->gambar)
            <img src="{{ asset('storage/' . $model->gambar) }}" class="img-preview img-fluid mb-3 col-sm-3 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-3">
            @endif
            <input class="form-control  @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()">
            @error('gambar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary mb-3" type="submit" onclick="return confirm('Apakah anda yakin ingin merubah ini?')">Update Data</button>
        <a href="/dashboard/tipeKamar" class="btn btn-success mb-3">Kembali</a>
    
    </form>
</div>

    <script>

    function previewImage() {
    const image = document.querySelector('#gambar');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(OFREvent) {
    imgPreview.src = OFREvent.target.result;
    }
}
    </script>
@endsection