<?php

namespace App\Http\Controllers;

use App\Models\historistok;
use Illuminate\Http\Request;

class Pemesanan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanans = \App\Models\pemesanan::all();
        return view('Dashboard.Pemesanan.index',['pemesanans' => $pemesanans,'title' => 'Pengelolaan Pemesanan']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $produks = \App\Models\produk::all();
        $pelanggan = \App\Models\pelanggan::all();

        return view('Dashboard.Pemesanan.tambah',['produks' => $produks, 'title' => 'Pemesanan Baru','pelanggans' => $pelanggan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $pemesanan = new \App\Models\pemesanan($data);
        $pemesanan->save();
        $produk = \App\Models\produk::where('id',$pemesanan->produk_id)->first();
        $produk->jumlah_stok = $produk->jumlah_stok-$pemesanan->jumlah;
        $produk->save();
        $histori = new historistok();
        $histori->produk_id = $pemesanan->produk_id;
        $histori->perubahan = -$pemesanan->jumlah;
        $histori->jumlah_stok = $produk->jumlah_stok;
        $histori->save();
        return redirect()->route('pemesanan.index')->with('pesan','Pemesanan berhasil dilakukan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemesanan = \App\Models\pemesanan::where('id',$id)->first();
        $produk = \App\Models\produk::where('id',$pemesanan->produk_id)->first();
        $produk->jumlah_stok = $produk->jumlah_stok + $pemesanan->jumlah;
        $histori= new historistok();
        $histori->produk_id = $pemesanan->produk_id;
        $histori->perubahan = $pemesanan->jumlah;
        $histori->jumlah_stok = $produk->jumlah_stok;
        $produk->save();
        $histori->save();
        \App\Models\pemesanan::destroy($id);
        return redirect()->route('pemesanan.index')->with('pesan','Data berhasil dihapus!');
    }
}
