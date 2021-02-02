<?php
/** @var \App\Models\pemesanan $pemesanan */
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
                    <td>ID Pemesanan</td>
                    <td>Produk</td>
                    <td>Pelanggan</td>
                    <td>Tanggal Pemesanan</td>
                    <td>Jumlah</td>
                    <td>Keterangan</td>
                    <td>Status</td>
                </thead>
                @foreach($pemesanans as $no => $pemesanan)
                    <tr>
                        <td>{{$pemesanan->id}}</td>
                        <td>{{$pemesanan->produk->nama}}</td>
                        <td>{{$pemesanan->pelanggan->nama_pelanggan}}</td>
                        <td>{{$pemesanan->tanggal_pemesanan}}</td>
                        <td>{{$pemesanan->jumlah}}</td>
                        <td>{{$pemesanan->keterangan}}</td>
                        <td>{{$pemesanan->status}}</td>
                        <td class="align-middle text-right">
                            <div class="d-flex justify-content-end">
                                <div id="edit" class="ml-2 edit-action">
                                    <a class="btn btn-link p-0 text-primary" href="{{route('pemesanan.edit',$pemesanan->id)}}" title="Edit">
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                </div>
                                <form id="destroy" class="ml-2 destroy-action" role="form" method="post" action="{{route('pemesanan.destroy',$pemesanan->id)}}">
                                    {{method_field('DELETE')}}
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">        <input type="hidden" name="_method" value="DELETE">        <button class="btn btn-link p-0 text-danger" type="submit" title="Destroy" onclick="return confirm('Apa anda yakin ingin menghapus? ')">
                                        <i class="fas fa-trash fa-fw"></i>
                                    </button>
                                </form>
                            </div>
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
