<?php

use App\Models\FasilitasHotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasHotelController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TipeKamarController;
use App\Models\TipeKamar;

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

Route::get('/', function () {

    $item = TipeKamar::all();

    return view('home', [
        "title" => "Home",
        'active' => 'home',
        'items' => $item
    ]);
    
});

Route::get('/home', function () {

    $item = TipeKamar::all();

    return view('home', [
        "title" => "Home",
        'active' => 'home',
        'items' => $item
    ]);
})->name('home');

Route::get('/kamar', function () {

    $item = DB::select("SELECT * FROM fasilitas_list");

    return view('tipeKamar', [
        "title" => "Tipe Kamar",
        'active' => 'tipe_kamar',
        'items' => $item
    ]);
});

Route::get('/fasilitas', function () {
    return view('fasilitasHotel', [
        'title' => 'Fasilitas Hotel',
        'active' => 'fasilitas',
        'fasilitasHotel' => FasilitasHotel::all()
    ]);
});

//! Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout']);

//! Halaman utama admin dan resepsionis
Route::get('/dashboard', [DashboardController::class, 'indexAdmin'])->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'indexResepsionis'])->middleware('auth');

//!  Halaman Pemesanan
Route::post('/pemesanan', [ReservasiController::class, 'cekKamar'])->name('pesanKamar');
Route::get('/pemesanan/{nama_kamar}', [ReservasiController::class, 'pemesanan'])->name('pemesanan');
Route::get('/pemesanan', [ReservasiController::class, 'indexPesan']);
Route::post('/pemesanan/reservasi', [ReservasiController::class, 'PesanReservasi'])->name('reservasi.pesan');
Route::get('reservasi/cetakNota/{id}', [ReservasiController::class, 'cetakNota'])->name('reservasi.cetakNota');

//! admin
Route::resource('/dashboard/tipeKamar', TipeKamarController::class)->middleware('admin');
Route::resource('/dashboard/fasilitasHotel', FasilitasHotelController::class)->middleware('admin');
Route::resource('/dashboard/fasilitasKamar', FasilitasKamarController::class)->middleware('admin');

//! resepsionis
Route::resource('/dashboard/reservasi', ResepsionisController::class)->middleware('resepsionis');
Route::get('/dashboard/cetak/{id}', [ResepsionisController::class, 'cetakInvoice'])->middleware('resepsionis');
