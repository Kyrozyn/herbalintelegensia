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
