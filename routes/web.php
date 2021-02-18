<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pelanggan;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//auth
Route::get('/', [LoginController::class,'loginpage'])->name('login');
Route::post('/', [LoginController::class,'authenticate'])->name('authpost');
Route::get('/logout', [LoginController::class,'logout'])->name('logout')->middleware('auth');
//dashboard
Route::get('/dashboard', [Dashboard::class,'tes'])->name('indexdashboard')->middleware('auth');
//pelanggan
Route::get('/pelanggan',[Pelanggan::class,'index'])->name('pelangganindex')->middleware('auth');
Route::get('/pelanggan/tambah',[Pelanggan::class,'inputform'])->name('pelangganinput')->middleware('auth');
Route::post('/pelanggan/tambah',[Pelanggan::class,'inputaction'])->name('pelangganinputaction')->middleware('auth');
Route::get('/pelanggan/edit/{id}',[Pelanggan::class,'editform'])->name('pelanganedit')->middleware('auth');
Route::post('/pelanggan/edit',[Pelanggan::class,'editaction'])->name('pelanganeditaction')->middleware('auth');
Route::delete('/pelanggan/destroy/{id}',[Pelanggan::class,'hapusaction'])->name('pelanganhapusaction')->middleware('auth');
//user
Route::get('/user',[LoginController::class,'index'])->name('indexuser')->middleware('auth');
Route::get('/user/tambah',[LoginController::class,'usertambahform'])->name('tambahuser')->middleware('auth');
Route::post('/user/tambah',[LoginController::class,'usertambahaction'])->name('tambahuseraction')->middleware('auth');
Route::get('/user/edit/{id}',[LoginController::class,'usereditform'])->name('edituser')->middleware('auth');
Route::post('/user/edit',[LoginController::class,'usereditaction'])->name('edituseraction')->middleware('auth');
Route::delete('/user/destroy/{id}',[LoginController::class,'hapusaction'])->name('userhapusaction')->middleware('auth');
//produk
Route::resource('produk',\App\Http\Controllers\Produk::class);
Route::resource('pemesanan',\App\Http\Controllers\Pemesanan::class);
Route::resource('kendaraan',\App\Http\Controllers\Kendaraan::class);


//pengiriman
Route::get('/pengiriman/buat/{kendaraan}',[\App\Http\Controllers\Pengiriman::class,'buat'])->name('pengiriman.buat')->middleware('auth');
Route::get('/pengiriman/buat/',[\App\Http\Controllers\Pengiriman::class,'pilihkendaraan'])->name('pengiriman.pilihkendaraan')->middleware('auth');
Route::get('/pengiriman/buat/{kendaraan}/{rute}',[\App\Http\Controllers\Pengiriman::class,'buatinvoice'])->name('pengiriman.buatinvoice')->middleware('auth');
Route::get('/invoice/{id}',[\App\Http\Controllers\Pengiriman::class,'lihatinvoice'])->name('pengiriman.invoice')->middleware('auth');
Route::get('/invoice/',[\App\Http\Controllers\Pengiriman::class,'lihatsemuainfoice'])->name('pengiriman.lihatsemuainvoice')->middleware('auth');
