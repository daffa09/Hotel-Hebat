@extends('dashboard.layouts.main')

@section('container')
<div class="container rounded bg-white mt-5">

    <h2 class="title">Data Reservasi</h2>

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

    <div class="justify-content-start" style="margin-top: 50px; margin-bottom: -64px;">
        <div class="col-md-3">
            <form action="/dashboard/reservasi">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" onfocus="(this.type='date')"
                        placeholder="Search By Tanggal Check-in" name="search_tgl" value="{{ request('search_tgl') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-end mb-4 me-5 mt-4">
        <div class="col-md-5">
            <form action="/dashboard/reservasi">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Search by nama tamu.." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($items->count())


    <div class="table-responsive fs-6">
        <table class="table table-striped table-sm table-bordered" style="text-align:center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Status</th>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nama Tamu</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Tgl Pesan</th>
                    <th scope="col">Tgl Checkin</th>
                    <th scope="col">Tgl Checkout</th>
                    <th scope="col">Tipe Kamar</th>
                    <th scope="col">Jumlah Kamar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    @if ($item->status == "Check In")
                    <td class="badge bg-success text-white">{{ $item->status }}</td>
                    @elseif ($item->status == "Check Out")
                    <td class="badge bg-primary text-white">{{ $item->status }}</td>
                    @else
                    <td class="badge bg-danger text-white">{{ $item->status }}</td>
                    @endif

                    <td>{{ $item->nama_pemesan }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->nama_tamu }}</td>
                    <td>{{ $item->no_tlp }}</td>
                    <td>{{ $item->tgl_pesan }}</td>
                    <td>{{ $item->tgl_checkin }}</td>
                    <td>{{ $item->tgl_checkout }}</td>
                    <td>{{ $item->nama_kamar }}</td>
                    <td>{{ $item->jml_kamar }}</td>
                    <td>
                        @if ($item->status == "Pending")
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Proses
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Proses Reservasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        {{-- TOMBOL Check In --}}
                                        <form action="{{ url('/dashboard/reservasi/'.$item->id)  }}" method="POST"
                                            class="d-inline d-flex mt-2" style="margin-left: 155px">
                                            @method('delete')
                                            <input type="hidden" name="status" value="Check In">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            @csrf
                                            <button class="btn btn-success border-0 text-white"
                                                onclick="return confirm('Anda Yakin Ingin Mengkonfirmasi Reservasi ini?')">Konfirmasi
                                                Pesanan</button>
                                        </form>

                                        {{-- TOMBOL BATAL --}}
                                        <form action="{{ url('/dashboard/reservasi/'.$item->id)  }}" method="POST"
                                            class="d-inline d-flex mt-2" style="margin-left: 163px">
                                            @method('delete')
                                            <input type="hidden" name="status" value="Batal">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            @csrf
                                            <button class="btn btn-warning border-0 text-white"
                                                onclick="return confirm('Anda Yakin Ingin Membatalkan Reservasi ini?')">Batalkan
                                                Pesanan</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($item->status == "Check In")
                        <a href="{{ url('/dashboard/cetak/'.$item->id) }}"
                            class="btn btn-success text-decoration-none text-white">Lihat</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Proses
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Proses Reservasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- TOMBOL CHECK OUT --}}
                                        <form action="{{ url('/dashboard/reservasi/'.$item->id)  }}" method="POST"
                                            class="d-inline d-flex mt-2" style="margin-left: 155px">
                                            @method('delete')
                                            <input type="hidden" name="status" value="Check Out">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            @csrf
                                            <button class="btn btn-danger border-0"
                                                onclick="return confirm('Anda Yakin Ingin Merubah Status Reservasi ini?')">Check
                                                Out Pesanan</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($item->status == "Check Out")
                        <a href="{{ url('/dashboard/cetak/'.$item->id) }}"
                            class="btn btn-success text-decoration-none text-white"
                            onloadstart="myFunction();">Lihat</a>
                        @else
                        <a href="{{ url('/dashboard/cetak/'.$item->id) }}"
                            class="btn btn-success text-decoration-none text-white">Lihat</a>
                        @endif
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