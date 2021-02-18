<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


class Pelanggan extends Controller
{
    public function index()
    {
        $pelanggans = \App\Models\pelanggan::all();
        return view('Dashboard.Pelanggan.index',['pelanggans' => $pelanggans,'title' => 'Pengolahan Pelanggan']);
    }

    public function inputform(){
        return view('Dashboard.Pelanggan.tambah',['title' => 'Tambah Pelanggan']);
    }

    public function inputaction(Request $request){
        $data = $request->except('_token');
        if(\App\Models\pelanggan::insert($data)){
            return redirect('/pelanggan')->with('pesan','Data berhasil ditambahkan!');
        }
    }

    public function editform($id){
        $pelanggan = \App\Models\pelanggan::whereId($id)->first();
        return view('Dashboard.Pelanggan.edit',['pelanggan'=>$pelanggan,'title' => 'Tambah Pelanggan']);
    }

    public function editaction(Request $request){
        if(\App\Models\pelanggan::where('id',$request->post('id'))
        ->update($request->except(['_token','id']))){
            return redirect('/pelanggan')->with('pesan','Data berhasil diedit!');
        }
        else{
            return redirect('/pelanggan')->with('pesan','Data berhasil diedit!');
        }
    }

    public function hapusaction($id)
    {
        \App\Models\pelanggan::destroy($id);
        return redirect('/pelanggan')->with('pesan','Data berhasil dihapus!');
    }

    public function laporanpelanggan()
    {
        $pelanggans = \App\Models\pelanggan::all();
        return view('Dashboard.Laporan.pelanggan',compact('pelanggans'));
    }
}
