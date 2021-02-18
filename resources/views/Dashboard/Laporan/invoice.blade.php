<?php
/** @var \App\Models\invoice $invoice */
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body{
            -webkit-print-color-adjust:exact;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-1"><img style="height: 100px" src="{{url('assets/images/logo.png')}}"></div>
    <div class="col-11">
        <h4 class="text-center">Herbal Intelegensia</h4>
        <h5 class="text-center">Jl. Permata Permai XIII No. 1 Cisaranten, Arcamanik </h5>
        <h6 class="text-center">Kota Bandung</h6>
    </div>
</div>
<hr>
<hr>
<div class="row">
    <div class="col-12">
        <h4 class="text-center">Invoice </h4>
    </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td style="width: 20%">ID Invoice</td>
                <td style="width: 1%;">:</td>
                <td>{{$invoice->id}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Jumlah Pesanan</td>
                <td style="width: 1%;">:</td>
                <td>{{$invoice->pemesanans->count()}}</td>
            </tr>
            <tr>
                <td style="width: 20%">Plat No Kendaraan</td>
                <td style="width: 1%;">:</td>
                <td>{{$invoice->kendaraan->plat_no}}</td>
            </tr>
        </table>
    </div>
    <div class="row">
        <h5>Daftar Pemesanan : </h5>
    </div>
    <hr>
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr class="text-center">
                <th>ID Pemesanan</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Alamat</th>
                <th>Posisi Lat</th>
                <th>Posisi Long</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>No Telp</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoice->pemesanans as $no => $pemesanan)
            <tr>
                <td>{{$pemesanan->id}}</td>
                <td>{{$pemesanan->pelanggan->nama_pelanggan}}</td>
                <td>{{$pemesanan->produk->nama}}</td>
                <td>{{$pemesanan->pelanggan->alamat}}</td>
                <td>{{$pemesanan->pelanggan->lat}}</td>
                <td>{{$pemesanan->pelanggan->long}}</td>
                <td>{{$pemesanan->jumlah}}</td>
                <td>{{$pemesanan->keterangan}}</td>
                <td>{{$pemesanan->pelanggan->no_telp}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rute</h5>
                    <p class="card-text">Gudang-{{$invoice->rute}}-Gudang</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <font size="5px" >Peta Rute</font>
            <div id="maps" class="center" style="width: 580px; height: 368px;"></div>
        </div>
    </div>
</div>
<div class="row">
    <h6>Dicetak pada tanggal {{date('d-m-Y')}} jam {{date("h:i:sa")}}</h6>
</div>
<script type="text/javascript">
    window.print();
</script>
<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyABAiRMExl_KVCugrFbUO5FJwNTo_94vt0&libraries=places"></script>
<script>
    function initMap() {
        var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng({{$lat_toko}}, {{$long_toko}}),
            mapTypeId: 'roadmap'
        };
        var map = new google.maps.Map(document.getElementById('maps'), mapOptions);
        var roadTripCoordinates = [
            {lat:{{$lat_toko}},lng: {{$long_toko}}},
                @foreach($invoice->pemesanans as $no => $pemesanan)
            {lat:{{$pemesanan->pelanggan->lat}},lng: {{$pemesanan->pelanggan->long}}},
                @endforeach
            {lat:{{$lat_toko}},lng: {{$long_toko}}}
        ]
        var roadTrip = new google.maps.Polyline({
            path: roadTripCoordinates,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        var info_window = new google.maps.InfoWindow();
        //marker toko
        var markertoko = new google.maps.Marker({
            position: new google.maps.LatLng({{$lat_toko}}, {{$long_toko}}),
            title: 'Posisi Gudang',
            map: map,
            draggable: false,
            animation: google.maps.Animation.BOUNCE,
            icon:{
                url: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            }
        });
        google.maps.event.addListener(markertoko, 'click', function () {
            info_window.setContent('<b>' + 'Posisi Gudang' + '</b>');
            info_window.open(map, this);
        });
        //marker pesanan
        @foreach($invoice->pemesanans as $noo => $pemesanan)
        var marker{{$noo}} = new google.maps.Marker({
            position: new google.maps.LatLng({{$pemesanan->pelanggan->lat}}, {{$pemesanan->pelanggan->long}}),
            title: 'Pemesanan No {{$pemesanan->id}}',
            map: map,
            draggable: false,
            animation: google.maps.Animation.BOUNCE
        });
        google.maps.event.addListener(marker{{$noo}}, 'click', function () {
            info_window.setContent('<b>' + 'Pemesanan No {{$pemesanan->id}}' + '</b>');
            info_window.open(map, this);
        });
        @endforeach
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < roadTripCoordinates.length; i++) {
            bounds.extend(roadTripCoordinates[i]);
        }
        bounds.getCenter();

        roadTrip.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', initMap());
</script>
</body>
</html>
