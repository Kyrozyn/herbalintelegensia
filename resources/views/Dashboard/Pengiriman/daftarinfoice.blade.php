<?php
/** @var \App\Models\invoice $invoice */
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
                <td>ID Invoice</td>
                <td>Aksi</td>
                </thead>
                @foreach($invoices as $no => $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td class="align-middle text-right">
                           <a href="{{url('/invoice/'.$invoice->id)}}" class="btn btn-primary">Lihat Invoice</a>
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
