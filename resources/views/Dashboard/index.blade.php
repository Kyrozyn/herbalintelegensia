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
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Pemesanan</h5>
                        <canvas id="pemesanan"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Pemesanan Belum Dikirim</h5>
                        <canvas id="pemesanan_belum_dikirim" ></canvas>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Pemesanan Dikirim</h5>
                        <canvas id="pemesanan_dikirim" ></canvas>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('script')
{{--    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('pemesanan').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($pemesanans as $key => $pemesanan)
                        @if($key == array_key_last($pemesanans))
                        "{{$pemesanan->tanggal_pemesanan}}"
                    @else
                        "{{$pemesanan->tanggal_pemesanan}}",
                    @endif
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: [
                        @foreach($pemesanans as $key => $pemesanan)
                        @if($key == array_key_last($pemesanans))
                        {{$pemesanan->jumlah}}
                        @else
                        {{$pemesanan->jumlah.","}}
                        @endif
                        @endforeach],
                    borderWidth: 1
                }]
            },
        });
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
<script>
    var ctx = document.getElementById('pemesanan_belum_dikirim').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($pemesanans_belum_dikirim as $key => $pemesanan)
                    @if($key == array_key_last($pemesanans))
                    "{{$pemesanan->tanggal_pemesanan}}"
                @else
                    "{{$pemesanan->tanggal_pemesanan}}",
                @endif
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: [
                    @foreach($pemesanans_belum_dikirim as $key => $pemesanan)
                    @if($key == array_key_last($pemesanans))
                    {{$pemesanan->jumlah}}
                    @else
                    {{$pemesanan->jumlah.","}}
                    @endif
                    @endforeach],
                borderWidth: 1
            }]
        },
    });
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
</script>
<script>
    var ctx = document.getElementById('pemesanan_dikirim').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($pemesanans_dikirim as $key => $pemesanan)
                    @if($key == array_key_last($pemesanans))
                    "{{$pemesanan->tanggal_pemesanan}}"
                @else
                    "{{$pemesanan->tanggal_pemesanan}}",
                @endif
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: [
                    @foreach($pemesanans_dikirim as $key => $pemesanan)
                    @if($key == array_key_last($pemesanans))
                    {{$pemesanan->jumlah}}
                    @else
                    {{$pemesanan->jumlah.","}}
                    @endif
                    @endforeach],
                borderWidth: 1
            }]
        },
    });
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
</script>
@endsection
