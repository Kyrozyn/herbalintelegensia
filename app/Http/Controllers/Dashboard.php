<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function tes()
    {
        $pemesanans = \App\Models\pemesanan::all()->count();
        $pemesanans_belum_dikirim = \App\Models\pemesanan::where('status','Belum Dikirim')->get()->count();
        $pemesanans_dikirim = \App\Models\pemesanan::where('status','Dikirim')->get()->count();
        return view('Dashboard.index',['title' => '','pemesanans'=>$pemesanans,'pemesanans_belum_dikirim' => $pemesanans_belum_dikirim,'pemesanans_dikirim' => $pemesanans_dikirim]);
    }
}
