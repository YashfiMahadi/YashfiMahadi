<?php

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

Route::get('/', 'HomeController@home')->name('home');
Route::get('/input/transaksi', 'HomeController@transaksi')->name('transaksi');
Route::post('/input/transaksi/pilih/cust', 'HomeController@pilihcust')->name('pilihcust');
Route::post('/input/transaksi/pilih/custu', 'HomeController@pilihcustu')->name('pilihcustu');
Route::post('/input/transaksi/pilih/custh', 'HomeController@pilihcusth')->name('pilihcusth');
Route::get('/input/transaksi/tambah/barang', 'HomeController@tambah')->name('tambahbarang');
Route::post('/input/transaksi/input/barang', 'HomeController@input')->name('inputbarang');
Route::get('/input/transaksi/{t_sales_det}/ubah/barang', 'HomeController@ubah')->name('ubahbarang');
Route::post('/input/transaksi/edit/barang', 'HomeController@edit')->name('editbarang');
Route::get('/input/transaksi/{t_sales_det}/hapus/barang', 'HomeController@hapus')->name('hapusbarang');
Route::get('/input/transaksi/ubah/barang', 'HomeController@ubah')->name('ubahbarang');
Route::get('/input/transaksi/update/barang', 'HomeController@update')->name('updatebarang');
Route::get('/input/transaksi/hapus/barang', 'HomeController@hapus')->name('hapusbarang');
Route::get('/input/transaksi/{t_sales}/batal', 'HomeController@batal')->name('batal');
Route::post('/input/transaksi/simpan', 'HomeController@simpan')->name('simpan');
Route::get('/input/transaksi/checkout', 'HomeController@checkout')->name('checkout');
Route::post('/input/transaksi/check', 'HomeController@check')->name('check');
