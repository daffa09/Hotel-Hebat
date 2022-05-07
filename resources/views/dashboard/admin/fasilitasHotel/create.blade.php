@extends('dashboard.layouts.main')

@section('container')

<div class="container-fluid bg-light" style="border-radius: 10px">

    <form class="col-md-8 mt-4 p-2" action="/dashboard/fasilitasHotel" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
            <label for="nama_fasilitas_hotel" class="form-label @error('nama_fasilitas_hotel') is-invalid @enderror">Nama Fasilitas Hotel</label>
            <input type="text" name="nama_fasilitas_hotel" id="nama_fasilitas_hotel" class="form-control" placeholder="Nama fasilitas hotel.." required value="{{ old('nama_fasilitas_hotel') }}">
            @error('nama_fasilitas_hotel')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label @error('keterangan') is-invalid @enderror">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan.." required value="{{ old('keterangan') }}" cols="30" rows="10"></textarea>
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label ">Gambar Fasilitas Hotel</label>
            <img class="img-preview img-fluid mb-3 col-sm-3">
            <input class="form-control  @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()">
            @error('gambar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary mb-3" type="submit" onclick="return confirm('Apakah anda yakin ingin menambah ini?')">Tambah Data</button>
        <a href="/dashboard/fasilitasHotel" class="btn btn-success mb-3">Kembali</a>
        <button type="reset" class="btn btn-warning text-white mb-3">Reset</button>
        
    
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