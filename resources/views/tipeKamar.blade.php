@extends('layouts.main')

@section('container')

<h1>Tipe Kamar</h1>


{{-- @if ($items->count()) --}}

@foreach ($items as $item)
<div class="tipe mt-5">
    <a href="/pemesanan/{{ $item->id }}">
        <img src="{{ asset('/storage/'.$item->gambar) }}" width="1310" height="400"
            class="align-items-center shadow p-3 mb-3 bg-body rounded" alt="Tipe Kamar">
    </a>
    <h3>{{ $item->nama_kamar }}</h3>
    <?php
                $list = explode(',', $item->fasilitas_list);
            ?>
    @if($list[0] !== '')
    <p class="lead">Pada Tipe Kamar ini, terdapat fasilitas sebagai berikut: </p>
    <ul>
        @for($i=0; $i < count($list); $i++) <li>{{ $list[$i] }}</li>
            @endfor
    </ul>
    @endif
</div>
@endforeach

{{-- @else
<p class="text-center fs-4 mt-5 mb-5 pb-5">Data Tidak Ditemukan</p>
@endif --}}



@endsection