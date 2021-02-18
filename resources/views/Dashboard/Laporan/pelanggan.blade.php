<?php
/** @var \App\Models\pelanggan[] $pelanggans */
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
        <h4 class="text-center">Laporan Pelanggan</h4>
    </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td style="width: 20%">Jumlah Pelanggan</td>
                <td style="width: 1%;">:</td>
                <td>{{count($pelanggans)}}</td>
            </tr>
        </table>
    </div>
    <div class="row">
        <h5>Daftar Pelanggan : </h5>
    </div>
    <hr>
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Posisi Lat</th>
                <th>Posisi Long</th>
                <th>No Telp</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pelanggans as $no => $pelanggan)
                <tr>
                    <td>{{$no+1}}</td>
                    <td>{{$pelanggan->nama_pelanggan}}</td>
                    <td>{{$pelanggan->alamat}}</td>
                    <td>{{$pelanggan->lat}}</td>
                    <td>{{$pelanggan->long}}</td>
                    <td>{{$pelanggan->no_telp}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <h6>Dicetak pada tanggal {{date('d-m-Y')}} jam {{date("h:i:sa")}}</h6>
</div>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>
