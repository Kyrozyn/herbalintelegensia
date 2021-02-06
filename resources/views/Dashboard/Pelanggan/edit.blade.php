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
            {{Aire::input('no_telp','No Telepon')->id('no_telp')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('alamat','Alamat')->id('alamat')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-2">
            <a href="#" id="cariposisi" class="btn btn-primary btn-block">Cari Posisi</a>
        </div>
    </div>
    <div id="maps" class="center" style="width: 580px; height: 368px;"></div>
    <div class="row" style="padding-top: 10px">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('lat','Posisi Latitude')->id('lat')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::input('long','Posisi Longitude')->id('long')->required()}}
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-lg-6">
            {{Aire::submit('Input Pelanggan')}}
        </div>
    </div>
    {{ Aire::close() }}
@endsection

@section('script')
    <script type="text/javascript"
            src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyABAiRMExl_KVCugrFbUO5FJwNTo_94vt0&libraries=places"></script>
    <script>
        var gmarkers = [];
        function init() {

            // membuat peta
            var map = new google.maps.Map(document.getElementById('maps'), {
                'center': {lat: -6.91757808164908, lng: 107.60850421142572},
                'zoom': 10,
                scaleControl: true,
                'mapTypeId': google.maps.MapTypeId.ROADMAP
            });
            map.addListener('click', function (event){

                //jquery
                $("#lat").val(event.latLng.lat());//mengambil nilai latitude dan ditampilkan nantinya di form input
                $("#long").val(event.latLng.lng());//mengambil nilai longitude dan ditampilkan nantinya di form input
                console.log(event.latLng.lng())
                //inisialisasi marker
                var marker1 = new google.maps.Marker({
                    position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                    title: 'lokasi',
                    map: map,
                    draggable: false,
                    animation: google.maps.Animation.BOUNCE
                });
                removeMarkers();
                gmarkers.push(marker1);
            });
            /*var marker1 = new google.maps.Marker({
                position: new google.maps.LatLng("-6.940753511329508", "107.5770901794433"),
                title: 'lokasi',
                map: map,
                draggable: false,
            });*/
            var myEl = document.getElementById('cariposisi');

            myEl.addEventListener('click',function(){
                // mengambil isi dari textarea dengan id alamat
                var alamat = document.getElementById('alamat').value;
                console.log(alamat);
                // membuat geocoder
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode(
                    {'address': alamat},
                    function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            var info_window = new google.maps.InfoWindow();

                            // mendapatkan lokasi koordinat
                            var geo = results[0].geometry.location;

                            // set koordinat
                            var pos = new google.maps.LatLng(geo.lat(), geo.lng());

                            //cek lat long di dalam polygon
                            var point = new google.maps.LatLng(geo.lat(), geo.lng());

                            var lat = document.getElementById('lat').value = geo.lat();
                            var lng = document.getElementById('long').value = geo.lng();
                            // menambahkan marker pada peta
                            var marker1 = new google.maps.Marker({
                                position: new google.maps.LatLng(lat, lng),
                                title: 'lokasi',
                                map: map,
                                draggable: false,
                                animation: google.maps.Animation.BOUNCE
                            });
                            map.setZoom(15)
                            map.panTo(marker1.position)
                            removeMarkers();
                            gmarkers.push(marker1);
                            // menambahkan event click ketika marker di klik
                            google.maps.event.addListener(market1, 'click', function () {
                                info_window.setContent('<b>' + alamat + '</b>');
                                info_window.open(map, this);

                            });
                        } else {
                            alert('Lokasi Tidak Ditemukan');
                        }
                    });
            },false)
        }
        function removeMarkers() {
            for (i = 0; i < gmarkers.length; i++) {
                gmarkers[i].setMap(null);
            }
        }


        google.maps.event.addDomListener(window, 'load', init);
    </script>
@endsection
