<?php
/** @var \App\Models\invoice  $invoice*/
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
                        <h5 class="card-title">ID Invoice</h5>
                        <p class="card-text">{{$invoice->id}} </p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Barang</h5>
                        <p class="card-text">{{$invoice->pemesanans->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Plat No</h5>
                        <p class="card-text">{{$invoice->kendaraan->plat_no}}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
            <div class="row" style="padding-top: 10px;padding-bottom: 10px">
                <div class="col-12">
                    <a href="{{url('/laporan/invoice/'.$invoice->id)}}" class="btn btn-block btn-primary">Cetak Invoice</a>
                </div>
            </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered bg-white" id="pemesanan">
                    <thead>
{{--                    <td>No</td>--}}
                    <td>ID Pemesanan</td>
                    <td>Produk</td>
                    <td>Pelanggan</td>
                    <td>Tanggal Pemesanan</td>
                    <td>Jumlah</td>
                    <td>Keterangan</td>
                    </thead>
                    @foreach($invoice->pemesanans as $no => $pemesanan)
                        <tr>
{{--                            <td>{{$no+1}}</td>--}}
                            <td>{{$pemesanan->id}}</td>
                            <td>{{$pemesanan->produk->nama}}</td>
                            <td>{{$pemesanan->pelanggan->nama_pelanggan}}</td>
                            <td>{{$pemesanan->tanggal_pemesanan}}</td>
                            <td>{{$pemesanan->jumlah}}</td>
                            <td>{{$pemesanan->keterangan}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
            <hr>
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
    @endif
@endsection
