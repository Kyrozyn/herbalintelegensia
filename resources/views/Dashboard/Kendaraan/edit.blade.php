<?php
/** @var \App\Models\kendaraan $kendaraan
 */
?>
@extends('Dashboard.template.template')
@section('content')

    {{Aire::open()->route('kendaraan.update',$kendaraan->id)->bind($kendaraan)}}
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('plat_no','Nomor Plat Kendaraan')->id('plat_no')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('nama_kendaraan','Nama Kendaraan')->id('nama_kendaraan')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::number('kapasitas','Kapasitas')->id('kapasitas')->required()->append('Kg')}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::submit('Edit Kendaraan')}}
        </div>
    </div>
    {{ Aire::close() }}
@endsection
