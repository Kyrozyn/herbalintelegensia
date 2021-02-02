<?php

namespace App\Http\Controllers;

use App\Models\historistok;
use Illuminate\Http\Request;

class Produk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $produk = \App\Models\produk::all();
        return view('Dashboard.Produk.index',['produk'=> $produk,'title'=>'Pengelolaan Produk']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Produk.tambah',['title' => 'Tambah Produk']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $produk = \App\Models\produk::create($data);
        $produk->save();
        $histori = new historistok();
        $histori->jumlah_stok = $data['jumlah_stok'];
        $histori->perubahan = $data['jumlah_stok'];
        $histori->produk_id = $produk->id;
        $histori->save();
        return redirect()->route('produk.index')->with('pesan','Produk Berhasil Ditambahkan');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $produk = \App\Models\produk::where('id',$id)->first();
        return view('Dashboard.Produk.edit',['produk' => $produk,'title' => 'Edit Produk']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\App\Models\produk::where('id',$id)
            ->update($request->except(['_token','id','_method']))){
            return redirect()->route('produk.index')->with('pesan','Data berhasil diedit!');
        }
        else{
            return redirect()->route('produk.index')->with('pesan','Data berhasil diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Models\produk::destroy($id);
        return redirect()->route('produk.index')->with('pesan','Data berhasil dihapus!');
    }


}
