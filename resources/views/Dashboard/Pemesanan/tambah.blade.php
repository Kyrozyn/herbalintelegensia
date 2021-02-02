<?php
/** @var \App\Models\pelanggan $pelanggan */
/** @var \App\Models\produk $produk */
?>
@extends('Dashboard.template.template')
@section('content')
    {{Aire::open()->route('pemesanan.store')}}
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label"
                   for="produk_id">
                ID Produk
            </label>
            <input list="produk_list" type="text"
                   class="block w-full leading-normal bg-white border rounded-sm p-2 text-base text-gray-900"
                   data-aire-component="input" name="produk_id" id="produk_id" required data-aire-for="produk_id"/>
            <datalist id="produk_list">
                @foreach($produks as $produk)
                    <option value="{{$produk->id}}">{{$produk->nama}}</option>
                @endforeach
            </datalist>
            @if(Request::user()->hasRole('Sales Operational Manager'))
                <div id="pelanggan baru" style="padding-bottom: 10px" class="form-text text-active"><a
                        href="{{route('produk.create')}}">Tambah Produk Baru</a></div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label"
                   for="pelanggan_id">
                ID Pelanggan
            </label>
            <input list="pelanggan_list" type="text"
                   class="block w-full leading-normal bg-white border rounded-sm p-2 text-base text-gray-900"
                   data-aire-component="input" name="pelanggan_id" id="pelanggan_id" required
                   data-aire-for="pelanggan_id"/>
            <datalist id="pelanggan_list">
                @foreach($pelanggans as $pelanggan)
                    <option value="{{$pelanggan->id}}">{{$pelanggan->nama_pelanggan}}</option>
                @endforeach
            </datalist>
            @if(Request::user()->hasRole('Sales Operational Manager'))
                <div id="pelanggan baru" style="padding-bottom: 10px" class="form-text text-active"><a
                        href="{{route('pelangganinput')}}">Tambah Pelanggan Baru</a></div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::dateTimeLocal('tanggal_pemesanan','Tanggal Pemesanan')->id('tanggal_pemesanan')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('keterangan','Keterangan')->id('keterangan')}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::number('jumlah','Jumlah')->id('jumlah')->required()}}
        </div>
    </div>
    {{Aire::hidden('status','Belum Dikirim')}}
    {{Aire::hidden('user_id',Auth::id())}}
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::submit('Input Pemesanan')}}
        </div>
    </div>
    {{ Aire::close() }}
@endsection
