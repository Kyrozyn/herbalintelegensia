<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kendaraan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraans = \App\Models\kendaraan::all();
        return view('Dashboard.Kendaraan.index',['kendaraans' => $kendaraans,'title' => 'Pengelolaan Kendaraan']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Kendaraan.tambah',['title' => 'Tambah Kendaraan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kendaraan = new \App\Models\kendaraan($request->except(['_token']));
        $kendaraan->save();
        return redirect()->route('kendaraan.index')->with('pesan','Kendaraan berhasil ditambahkan!');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kendaraan = \App\Models\kendaraan::where('id',$id)->first();
        return view('Dashboard.Kendaraan.edit',['kendaraan' => $kendaraan,'title' => 'Edit Kendaraan']);
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
        if(\App\Models\kendaraan::where('id',$id)
            ->update($request->except(['_token','id','_method']))){
            return redirect()->route('kendaraan.index')->with('pesan','Data berhasil diedit!');
        }
        else{
            return redirect()->route('kendaraan.index')->with('pesan','Data berhasil diedit!');
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
        \App\Models\kendaraan::destroy($id);
        return redirect()->route('kendaraan.index')->with('pesan','Kendaraan berhasil dihapus');
    }
}
