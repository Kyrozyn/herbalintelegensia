<?php
/** @var \App\Models\produk $produk
 */
?>
@extends('Dashboard.template.template')
@section('content')

    {{Aire::open()->route('produk.update',$produk->id)->bind($produk)}}
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
            {{Aire::submit('Edit Produk')}}
        </div>
    </div>
    {{ Aire::close() }}
@endsection
