<?php
/** @var \App\Models\kendaraan[] $kendaraans */
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
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" id="pelanggan">
                <thead>
                <td>Nomor Plat Kendaraan</td>
                <td>Nama Kendaraan</td>
                <td>Kapasitas</td>
                <td>Aksi</td>
                </thead>
                @foreach($kendaraans as $no => $kendaraan)
                    <tr>
                        <td>{{$kendaraan->plat_no}}</td>
                        <td>{{$kendaraan->nama_kendaraan}}</td>
                        <td>{{$kendaraan->kapasitas}} Box</td>
                        <td class="align-middle text-right">
                            <a href="{{url('/pengiriman/buat/'.$kendaraan->id)}}" class="btn btn-primary">Pilih</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#pelanggan').DataTable(
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
