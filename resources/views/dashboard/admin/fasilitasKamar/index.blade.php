@extends('dashboard.layouts.main')

@section('container')
<div class="container rounded bg-white mt-5">

    <h2 class="title">Fasilitas Kamar</h2>

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

    <div class="row justify-content-end mb-2 me-5">
        <div class="col-md-5">
            <form action="/dashboard/fasilitasKamar">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Search by tipe kamar.." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <a href="/dashboard/fasilitasKamar/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Tambah</a>

    @if ($items->count())


    <div class="table-responsive fs-6">
        <table class="table table-striped table-sm table-bordered" style="text-align:center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tipe Kamar</th>
                    <th scope="col">Fasilitas Kamar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kamar }}</td>
                    <td>{{ $item->nama_fasilitas_kamar }}</td>
                    <td>
                        <a href="{{ url('/dashboard/fasilitasKamar/'.$item->id.'/edit')  }}"
                            class="btn btn-warning text-decoration-none text-white"><span data-feather="edit"></span>
                            Ubah</a>
                        <form action="{{ url('/dashboard/fasilitasKamar/'.$item->id)  }}" method="POST"
                            class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger border-0"
                                onclick="return confirm('Anda Yakin Ingin Menghapus ini?')"><span
                                    data-feather="user-x"></span> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end mb-5">
            {{ $items->links() }}
        </div>
    </div>
</div>

@else
<p class="text-center fs-4 mt-5 pb-5">Data Tidak Ditemukan</p>
@endif

</div>
@endsection