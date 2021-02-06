<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pengiriman extends Controller
{
    private $lat = -6.923577, $long = 107.677748;
    public function buat()
    {
        $pemesanans = \App\Models\pemesanan::where('status','Belum Dikirim')->get();
        foreach ($pemesanans as $key => $pemesanan){
            $pemesanans[$key]->jarak = $this->hitungjarak($this->lat, $this->long,$pemesanan->pelanggan->lat,$pemesanan->pelanggan->long);
        }
        $arr = [];
        $arr[0][0] = 0;
        for ($baris=0;$baris<$pemesanans->count();$baris++){
            for ($kolom=0;$kolom<$pemesanans->count();$kolom++){
                $arr[$baris+1][$kolom+1] = $this->hitungjarak($pemesanans[$baris]->pelanggan->lat, $pemesanans[$baris]->pelanggan->long,$pemesanans[$kolom]->pelanggan->lat,$pemesanans[$kolom]->pelanggan->long);
                if($kolom>$baris){
                    $arr[$baris+1][$kolom+1] = 0;
                }
            }
            $arr[$baris+1][0] = $this->hitungjarak($this->lat, $this->long,$pemesanans[$baris]->pelanggan->lat,$pemesanans[$baris]->pelanggan->long);
        }
        $penghematan = [];
        for ($baris=0;$baris<$pemesanans->count();$baris++){
            for ($kolom=0;$kolom<$pemesanans->count();$kolom++) {
                if($baris > 0 AND $kolom > 0){
                    if($kolom>$baris){
                        app('debugbar')->info('debug: '.$baris.".".$kolom);
                        $penghematan[$baris][$kolom] = $arr[$baris][0] + $arr[$kolom][0] - $arr[$kolom][$baris];
                    }
                }

            }
        }
        app('debugbar')->info($arr);
        app('debugbar')->info('penghematan');
        app('debugbar')->info($penghematan);


        return view('Dashboard.Pengiriman.buatpengiriman',['title' => 'Buat Pengiriman','pemesanans' => $pemesanans,'arr' => $arr]);
    }

    private function hitungjarak($lat1, $lon1, $lat2, $lon2, $unit = 'K'){
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            }
            else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit = strtoupper($unit);

                if ($unit == "K") {
                    return ($miles * 1.609344);
                } else if ($unit == "N") {
                    return ($miles * 0.8684);
                } else {
                    return $miles;
                }
            }
    }


}
