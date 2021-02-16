<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pengiriman extends Controller
{
    private $lat = -6.923577, $long = 107.677748;
    public function buat($kendaraan)
    {
        $kendaraan = \App\Models\kendaraan::where('id',$kendaraan)->first();
        $pemesanans = \App\Models\pemesanan::where('status','Belum Dikirim')->get();
        if(empty($kendaraan)){
            return view('Dashboard.Pengiriman.buatpengiriman',['title' => 'Buat Pengiriman', 'pesan' => 'Kendaraan tidak ditemukan!']);
        }
        if($pemesanans->count()==0){
            return view('Dashboard.Pengiriman.buatpengiriman',['title' => 'Buat Pengiriman', 'pesan' => 'Semua Pesanan sudah dikirim!']);
        }
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
//                        app('debugbar')->info('debug: '.$baris.".".$kolom);
                        $penghematan[$baris][$kolom] = $arr[$baris][0] + $arr[$kolom][0] - $arr[$kolom][$baris];
                    }
                }
            }
        }
        $jalur = [];
        $rute = [];
        $rute_all = [];
        $box = 0;
        $iterasi =0;
       while (true){
           $iterasi++;
           $penghematan_high= -1;
           $penghematan_baris= -1;
           $penghematan_kolom= -1;
           for ($baris=0;$baris<$pemesanans->count();$baris++){
               for ($kolom=0;$kolom<$pemesanans->count();$kolom++) {
                   if($baris > 0 AND $kolom > 0){
                       if($kolom>$baris){
                           if($penghematan_high < $penghematan[$baris][$kolom]){
                               $penghematan_high = $penghematan[$baris][$kolom];
                               $penghematan_baris = $baris;
                               $penghematan_kolom = $kolom;
                           }
                       }
                   }
               }
           }
           app('debugbar')->info($penghematan_high);
           app('debugbar')->info($penghematan);

           if($penghematan_high == 0){
               break;
           }
           if($penghematan_high>0){
               if(empty($rute)){
                   $jumlah = $pemesanans[$penghematan_kolom]->jumlah + $pemesanans[$penghematan_baris]->jumlah;
                   if($jumlah > $kendaraan->kapasitas){
                       array_push($rute,$kolom);
                       for ($baris=0;$baris<$pemesanans->count();$baris++){
                           for ($kolom=0;$kolom<$pemesanans->count();$kolom++) {
                               if($baris > 0 AND $kolom > 0){
                                   if($kolom>$baris){
                                       $penghematan[$baris][$penghematan_kolom] = 0;
                                   }
                               }
                           }
                       }
                       array_push($rute_all,$rute);
                       $rute=[];
                   }
                   else{
                       array_push($rute,$kolom);
                       array_push($rute,$baris);
                       for ($baris=0;$baris<$pemesanans->count();$baris++){
                           for ($kolom=0;$kolom<$pemesanans->count();$kolom++) {
                               if($baris > 0 AND $kolom > 0){
                                   if($kolom>$baris){
                                       if($kolom == $penghematan_kolom){
                                           $penghematan[$baris][$kolom] = 0;
                                       }
                                   }
                               }
                           }
                       }
                   }
               }
               else{
                   $total_barang_di_rute = 0;
                   dd($rute);
                   foreach ($rute as $r){
                       $total_barang_di_rute = $total_barang_di_rute + $pemesanans[$a]->jumlah;
                   }
                   if(!in_array($penghematan_kolom,$rute)){
                       $temp = $total_barang_di_rute + $pemesanans[$penghematan_kolom]->jumlah;
                       if(!$temp>$kendaraan->kapasitas){
                           array_push($rute,$penghematan_kolom);
                       }
                   }
                   if(!in_array($penghematan_baris,$rute)){
                       $temp = $total_barang_di_rute + $pemesanans[$penghematan_baris]->jumlah;
                       if(!$temp>$kendaraan->kapasitas){
                           array_push($rute,$penghematan_baris);
                           for ($baris=0;$baris<$pemesanans->count();$baris++){
                               for ($kolom=0;$kolom<$pemesanans->count();$kolom++) {
                                   if($baris > 0 AND $kolom > 0){
                                       if($kolom>$baris){
                                           $penghematan[$penghematan_baris][$kolom] = $arr[$baris][0] + $arr[$kolom][0] - $arr[$kolom][$baris];
                                       }
                                   }
                               }
                           }
                       }
                   }
                   array_push($rute,$rute_all);
               }
           }
       }

//        app('debugbar')->info(max($penghematan));
//        app('debugbar')->info($rute_all);

//        app('debugbar')->info($penghematan);
//                app('debugbar')->info('high');

//        app('debugbar')->info($penghematan_high);
//        app('debugbar')->info($penghematan_baris);
//        app('debugbar')->info($penghematan_kolom);


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
