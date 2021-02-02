@extends('Dashboard.template.template')
@section('content')
    {{Aire::open()->route('produk.store')}}
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('nama','Nama Produk')->id('nama')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('deskripsi','Deskripsi')->id('deskripsi')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::number('jumlah_stok','Stok Awal')->id('jumlah_stok')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::submit('Tambah Produk')}}
        </div>
    </div>
    {{ Aire::close() }}
@endsection
