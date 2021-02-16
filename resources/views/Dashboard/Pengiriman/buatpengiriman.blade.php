<?php
/** @var \App\Models\pemesanan[] $pemesanans */
?>
@extends('Dashboard.template.template')
@section('content')
    @if(session('pesan'))
        <div class="row">
            <div class="col col-12">
                <div class="alert alert-info" role="alert">
                    {{session('pesan')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if(isset($pesan))
        <div class="row">
            <div class="col col-12">
                <div class="alert alert-danger" role="alert">
                    {{$pesan}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if(!isset($pesan))
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Barang Yang Belum Dikirim</h5>
                    <p class="card-text">{{count($pemesanans)}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered bg-white" id="pemesanan">
                <thead>
                <td>ID Pemesanan</td>
                <td>Produk</td>
                <td>Pelanggan</td>
                <td>Tanggal Pemesanan</td>
                <td>Jumlah</td>
                <td>Keterangan</td>
                <td>Jarak</td>
                </thead>
                @foreach($pemesanans as $no => $pemesanan)
                    <tr>
                        <td>{{$pemesanan->id}}</td>
                        <td>{{$pemesanan->produk->nama}}</td>
                        <td>{{$pemesanan->pelanggan->nama_pelanggan}}</td>
                        <td>{{$pemesanan->tanggal_pemesanan}}</td>
                        <td>{{$pemesanan->jumlah}}</td>
                        <td>{{$pemesanan->keterangan}}</td>
                        <td>{{$pemesanan->jarak}} Km</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endif
@endsection

@section('script')
<script>
    $('#pemesanan').DataTable(
        {{--{--}}
        {{--dom: 'Bfrtip',--}}
        {{--buttons: [--}}
        {{--    {--}}
        {{--        text: 'Tambah Pelanggan',--}}
        {{--        action: function ( e, dt, node, config ) {--}}
        {{--            window.location.href = "{{url('/pelanggan/tambah')}}";--}}
        {{--        }--}}
        {{--    }--}}
        {{--]--}}
        {{--}--}}
    );
    $('.alert').alert()
</script>
@endsection
