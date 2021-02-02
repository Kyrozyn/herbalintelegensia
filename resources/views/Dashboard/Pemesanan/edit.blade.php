<?php
/** @var \App\Models\pelanggan $pelanggan */
?>
@extends('Dashboard.template.template')
@section('content')

    {{Aire::open()->action(url('pelanggan/edit'))->bind($pelanggan)}}
    {{Aire::hidden('id',$pelanggan->id)}}
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('nama_pelanggan','Nama Pelanggan')->id('nama_pelanggan')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('alamat','Alamat')->id('alamat')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('no_telp','No Telepon')->id('no_telp')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::submit('Edit Pelanggan')}}
        </div>
    </div>
    {{ Aire::close() }}
@endsection
