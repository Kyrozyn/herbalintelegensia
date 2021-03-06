<?php
/** @var \App\Models\pemesanan[] $pemesanans */
/** @var \App\Models\kendaraan $kendaraan */
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
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Plat No</h5>
                    <p class="card-text">{{$kendaraan->plat_no}}</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kapasitas Kendaraan</h5>
                    <p class="card-text">{{$kendaraan->kapasitas}} Box</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered bg-white" id="pemesanan">
                <thead>
                <td>No</td>
                <td>ID Pemesanan</td>
                <td>Produk</td>
                <td>Pelanggan</td>
                <td>Tanggal Pemesanan</td>
                <td>Status Pengiriman</td>
                <td>Jumlah</td>
                <td>Keterangan</td>
                <td>Jarak dari Gudang</td>
                </thead>
                @foreach($pemesanans as $no => $pemesanan)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$pemesanan->id}}</td>
                        <td>{{$pemesanan->produk->nama}}</td>
                        <td>{{$pemesanan->pelanggan->nama_pelanggan}}</td>
                        <td>{{$pemesanan->tanggal_pemesanan}}</td>
                        @if($pemesanan->kirimplus == 'Pengiriman tidak tepat waktu (lebih dari +1 hari)')
                            <td><font color="red">{{$pemesanan->kirimplus}}</font></td>
                        @else
                        <td>{{$pemesanan->kirimplus}}</td>
                        @endif
                        <td>{{$pemesanan->jumlah}}</td>
                        <td>{{$pemesanan->keterangan}}</td>
                        <td>{{ceil($pemesanan->jarak)}} Km</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <font size="4px">Rekomendasi Rute Pengiriman</font>
            <table class="table table-bordered bg-white" id="pemesanan">
                <thead>
                <td>Rekomendasi Rute Ke-</td>
                <td>Rute Yang Akan Di tempuh (sesuai no)</td>
                <td>Aksi</td>
                </thead>
                @foreach($rute as $no => $rt)
                    @php($ruto = '')
                <tr>
                    <td>{{$no+1}}</td>
                    <td>Gudang - @foreach($rt as $r) {{$r}} -
                        <?php $ruto = $ruto.$r.'-';?>
                        @endforeach Gudang
                    </td>
                    <td><a href="{{url('pengiriman/buat/'.$kendaraan->id.'/'.$ruto)}}" class="btn btn-primary">Pilih rute Ini</a> </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    @foreach($rute as $no => $rt)
        <hr>
    <div class="row">
        <div class="col-12">
            <font size="5px" >Peta Rute ke-{{$no+1}}</font>
                    <div id="maps{{$no}}" class="center" style="width: 580px; height: 368px;"></div>
        </div>
    </div>
    @endforeach
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
<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyABAiRMExl_KVCugrFbUO5FJwNTo_94vt0&libraries=places"></script>
@if(!isset($pesan))
<script>@foreach($rute as $no => $rt)
    function initMap{{$no}}() {
        var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng({{$lat_toko}}, {{$long_toko}}),
            mapTypeId: 'roadmap'
        };
        var map{{$no}} = new google.maps.Map(document.getElementById('maps{{$no}}'), mapOptions);
        var roadTripCoordinates{{$no}} = [
            {lat:{{$lat_toko}},lng: {{$long_toko}}},
            @foreach($rt as $r)
            {lat:{{$pemesanans[$r-1]->pelanggan->lat}},lng: {{$pemesanans[$r-1]->pelanggan->long}}},
            @endforeach
            {lat:{{$lat_toko}},lng: {{$long_toko}}}
            ]
        var roadTrip{{$no}} = new google.maps.Polyline({
            path: roadTripCoordinates{{$no}},
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        var info_window = new google.maps.InfoWindow();
        //marker toko
        var markertoko = new google.maps.Marker({
            position: new google.maps.LatLng({{$lat_toko}}, {{$long_toko}}),
            title: 'Posisi Gudang',
            map: map{{$no}},
            draggable: false,
            animation: google.maps.Animation.BOUNCE,
            icon:{
                url: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            }
        });
        google.maps.event.addListener(markertoko, 'click', function () {
            info_window.setContent('<b>' + 'Posisi Gudang' + '</b>');
            info_window.open(map{{$no}}, this);
        });
        //marker pesanan
        @foreach($rt as $noo => $r)
        var marker{{$noo}} = new google.maps.Marker({
            position: new google.maps.LatLng({{$pemesanans[$r-1]->pelanggan->lat}}, {{$pemesanans[$r-1]->pelanggan->long}}),
            title: 'Pemesanan No {{$r}}',
            map: map{{$no}},
            draggable: false,
            animation: google.maps.Animation.BOUNCE
        });
        google.maps.event.addListener(marker{{$noo}}, 'click', function () {
            info_window.setContent('<b>' + 'Pemesanan No {{$r}}' + '</b>');
            info_window.open(map{{$no}}, this);
        });
        @endforeach
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < roadTripCoordinates{{$no}}.length; i++) {
            bounds.extend(roadTripCoordinates{{$no}}[i]);
        }
        bounds.getCenter();

        roadTrip{{$no}}.setMap(map{{$no}});
    }
    google.maps.event.addDomListener(window, 'load', initMap{{$no}}());
    @endforeach</script>
    @endif
@endsection
