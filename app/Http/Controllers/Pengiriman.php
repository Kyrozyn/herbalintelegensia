<?php

namespace App\Http\Controllers;

use App\Models\invoice;
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
        if($pemesanans->count()==1){
            $rute_all = [[1]];
            return view('Dashboard.Pengiriman.buatpengiriman',['title' => 'Buat Pengiriman', 'rute' => $rute_all,'pemesanans' => $pemesanans,'kendaraan' => $kendaraan]);
        }
        foreach ($pemesanans as $key => $pemesanan){
            $pemesanans[$key]->jarak = $this->hitungjarak($this->lat, $this->long,$pemesanan->pelanggan->lat,$pemesanan->pelanggan->long);
        }
        $arr = [];
        $arr[0][0] = 0;
        for ($baris=0;$baris<$pemesanans->count();$baris++){
            for ($kolom=0;$kolom<$pemesanans->count();$kolom++){
                $arr[$baris+1][$kolom+1] = ceil($this->hitungjarak($pemesanans[$baris]->pelanggan->lat, $pemesanans[$baris]->pelanggan->long,$pemesanans[$kolom]->pelanggan->lat,$pemesanans[$kolom]->pelanggan->long));
                if($kolom>$baris){
                    $arr[$baris+1][$kolom+1] = 0;
                }
                $arr[0][$kolom] = 0;
                $arr[0][$pemesanans->count()+1] = 0;
            }
            $arr[$baris+1][0] = ceil($this->hitungjarak($this->lat, $this->long,$pemesanans[$baris]->pelanggan->lat,$pemesanans[$baris]->pelanggan->long));
        }
        //Hitung Penghematannya
        $penghematan = [];
        for ($baris=0;$baris<$pemesanans->count()+1;$baris++){
            for ($kolom=0;$kolom<$pemesanans->count();$kolom++) {
                if($baris>$kolom){
                    if($kolom>0){
                        $penghematan[$baris][$kolom] = $arr[$baris][0] + $arr[$kolom][0] - $arr[$baris][$kolom];
//                        \Debugbar::debug('Menghitung : S'.$kolom.$baris.' = '.$arr[$baris][0].'+'.$arr[$kolom][0].'-'.$arr[$baris][$kolom].' = '.$penghematan[$baris][$kolom]);
                    }

                }
            }
        }
        //Iterasi
        $iterasi = 0;
        $check = [];
        $rute_all = [];
        $temp = 0;
        $rute = [];
        while (true){
//            \Debugbar::debug($penghematan);
            $iterasi++;
            $max_penghematan = -1;
            $max_kolom = -1;
            $max_baris = -1;
//            \Debugbar::debug('Iterasi ke = '.$iterasi);
            foreach (array_keys($penghematan) as $index_kolom){
                foreach (array_keys($penghematan[$index_kolom]) as $index_baris){
                    if($max_penghematan<$penghematan[$index_kolom][$index_baris]){
                        $max_penghematan = $penghematan[$index_kolom][$index_baris];
                        $max_kolom = $index_kolom;
                        $max_baris = $index_baris;
                    }
                }
            }
            if($max_penghematan ==0){
                    array_push($rute_all,$rute);
//                \Debugbar::debug('Rute Final Terbentuk = '.print_r($rute_all,1));
//                \Debugbar::debug('Iterasi Selesai Dengan Semua Rute = '.print_r($rute_all,1));

                break;
            }
            if($iterasi == 1) {
                $jumlah = $pemesanans[$max_kolom - 1]->jumlah + $pemesanans[$max_baris - 1]->jumlah;
                if ($jumlah < $kendaraan->kapasitas) {
                    array_push($rute, $max_kolom);
                    array_push($rute, $max_baris);
                    array_push($check, $max_baris);
                    array_push($check, $max_kolom);
//                    array_push($rute_all,$rute)
                    $temp = $temp + $jumlah;
//                    \Debugbar::debug('Rute Terbentuk = '.print_r($rute,1));
                } else {
                    //jadi 2 rute
                    if (!in_array($max_kolom, $check)) {
                        array_push($rute, $max_kolom);
                        array_push($check, $max_kolom);
                        array_push($rute_all, $rute);
                    }
                    $rute = [];
                    if (!in_array($max_baris, $check)) {
                        array_push($rute, $max_baris);
                        array_push($check, $max_baris);
//                        array_push($rute_all, $rute);
                        $temp = $temp + $jumlah;
                    }
                }
            }
            else{
//                \Debugbar::debug('Temp Sekarang = '.print_r($temp,1));
                $jumlah = $temp + $pemesanans[$max_kolom-1]->jumlah;
                if($jumlah<$kendaraan->kapasitas){
                    array_push($rute,$max_kolom);
                    $temp = $temp + $jumlah;
//                    \Debugbar::debug('Rute Terbentuk = '.print_r($rute,1));
                }
                else{
                    array_push($rute_all,$rute);
//                    \Debugbar::debug('Rute Final Terbentuk = '.print_r($rute_all,1));
                    $temp = 0;
                    $rute = [];
//                    \Debugbar::debug('Temp Sekarang = '.print_r($temp,1));
                    array_push($rute,$max_kolom);
                    $temp = $temp + $pemesanans[$max_kolom-1]->jumlah;
//                    \Debugbar::debug('Rute Terbentuk = '.print_r($rute,1));
                }
//                \Debugbar::debug('Temp Sekarang = '.print_r($temp,1));
                $jumlah = $temp + $pemesanans[$max_baris-1]->jumlah;
                if($jumlah<$kendaraan->kapasitas){
                    array_push($rute,$max_baris);
                    $temp = $temp + $jumlah;
//                    \Debugbar::debug('Rute Terbentuk = '.print_r($rute,1));
                }
                else{
                    array_push($rute_all,$rute);
//                    \Debugbar::debug('Rute Final Terbentuk = '.print_r($rute_all,1));
                    $temp = 0;
                    $rute = [];
                    array_push($rute,$max_baris);
                    $temp = $temp + $pemesanans[$max_baris-1]->jumlah;
//                    \Debugbar::debug('Rute Terbentuk = '.print_r($rute,1));

                }
            }


            //Hapus setelah di cari penghematan
            foreach (array_keys($penghematan) as $index_kolom){
                foreach (array_keys($penghematan[$index_kolom]) as $index_baris){
//                    \Debugbar::debug('Sekarang di '.$index_kolom.$index_baris);
                    if($index_baris == $max_baris OR $index_kolom == $max_kolom OR $max_baris == $index_kolom OR $max_kolom == $index_baris){
                        $penghematan[$index_kolom][$index_baris] = 0;
//                        \Debugbar::debug($index_kolom.' '.$index_baris.'= 0');
                    }
                }
            }
        }
     return view('Dashboard.Pengiriman.buatpengiriman',['title' => 'Buat Pengiriman','pemesanans' => $pemesanans,'rute'=>$rute_all,'kendaraan' =>$kendaraan,'lat_toko' => $this->lat,'long_toko'=>$this->long]);
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

    public function pilihkendaraan()
    {
        $kendaraans = \App\Models\kendaraan::all();
        $title = 'Pilih Kendaraan';
        return view('Dashboard.Pengiriman.pilihkendaraan',compact('kendaraans','title'));
    }

    public function buatinvoice($kendaraan,$rute)
    {
        $pemesanans = \App\Models\pemesanan::where('status','Belum Dikirim')->get();
        $invoice = new invoice();
        $rutes = explode('-',$rute);
        $rute_baru = '';
        $len = count($rutes)-1;
        foreach ($rutes as $index => $r) {
            if(!empty($r)){
                if($index == $len-1){
                    $rute_baru = $rute_baru.$pemesanans[$r-1]->id;
                }
                else{
                    $rute_baru = $rute_baru.$pemesanans[$r-1]->id.'-';
                }
            }
        }
        $invoice->rute = $rute_baru;
        $invoice->kendaraan_id = $kendaraan;
        $invoice->save();
        $rutes_baru = explode('-',$rute_baru);
        foreach ($rutes_baru as $r) {
            if(!empty($r)){
                $invoice->pemesanans()->attach($r);
                $pemesanans = \App\Models\pemesanan::whereId($r)->first();
                $pemesanans->status = 'Dikirim';
                $pemesanans->save();
            }
        }
        return redirect()->to('invoice/'.$invoice->id)->with('pesan','Invoice berhasil dibuat!');
    }

    public function lihatinvoice($id)
    {
        $invoice = invoice::whereId($id)->first();
        $rute = explode('-',$invoice->rute);
        return view('Dashboard.Pengiriman.invoice',['title'=> "Detail Invoice",'rute' => $rute,'invoice'=>$invoice,'lat_toko'=>$this->lat,'long_toko'=>$this->long]);
    }

    public function lihatsemuainfoice()
    {
        $invoice = invoice::all();
        return view('Dashboard.Pengiriman.daftarinfoice',['title'=>'Lihat Invoice','invoices'=>$invoice]);
    }

    public function cetakinvoice($id)
    {
        $invoice = invoice::whereId($id)->first();
        return view('Dashboard.Laporan.invoice',['invoice' => $invoice,'lat_toko'=>$this->lat,'long_toko'=>$this->long]);
    }

}
