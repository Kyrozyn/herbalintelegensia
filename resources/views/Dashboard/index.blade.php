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
        <font size="5px" style="padding-bottom: 40px;padding-left: 10px">Selamat Datang di Sistem Informasi Herbal Intelegensia</font>
    </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pemesanan</h5>
                        {{$pemesanans}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pemesanan Belum Dikirim</h5>
                        {{$pemesanans_belum_dikirim}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pemesanan Dikirim</h5>
                        {{$pemesanans_dikirim}}
                    </div>
                </div>
            </div>
        </div>

@endsection
