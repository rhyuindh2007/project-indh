<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
    return view('welcome',[
        "title"=>"Dashboard"
    ]);
});
Route::resource('pelanggan',PelangganController::class)->except('destroy')->middleware('auth');
Route::resource('pengguna',UserController::class)->except('destroy','create','show','update','edit')->middleware('auth');
Route::resource('barang',BarangController::class)->middleware('auth');

Route::get('login',[LoginController::class,'loginView'])->name('login');