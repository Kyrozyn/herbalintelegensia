<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function tes()
    {
        $pemesanans = DB::Select("Select count(DATE (`tanggal_pemesanan`)) as `jumlah`, DATE(`tanggal_pemesanan`) as `tanggal_pemesanan` from pemesanans group by DATE(`tanggal_pemesanan`) ORDER BY DATE(`pemesanans`.`tanggal_pemesanan`) DESC LIMIT 10");
        $pemesanans_belum_dikirim = DB::Select("Select count(DATE (`tanggal_pemesanan`)) as `jumlah`, DATE(`tanggal_pemesanan`) as `tanggal_pemesanan` from pemesanans where `status` = 'Belum Dikirim' group by DATE(`tanggal_pemesanan`) ORDER BY DATE(`pemesanans`.`tanggal_pemesanan`) DESC LIMIT 10 ");
        $pemesanans_dikirim = DB::Select("Select count(DATE (`tanggal_pemesanan`)) as `jumlah`, DATE(`tanggal_pemesanan`) as `tanggal_pemesanan` from pemesanans where `status` = 'Dikirim' group by DATE(`tanggal_pemesanan`) ORDER BY DATE(`pemesanans`.`tanggal_pemesanan`) DESC LIMIT 10 ");
        return view('Dashboard.index',['title' => 'Beranda','pemesanans'=>$pemesanans,'pemesanans_belum_dikirim' => $pemesanans_belum_dikirim,'pemesanans_dikirim' => $pemesanans_dikirim]);
    }
}
