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


Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');


Route::group(['middleware' => 'auth'], function () {
Route::get('/', function () {
    return view('dashboard');
})->name('home');
Route::get('logout', 'AuthController@logout')->name('logout');
 
//DATA BANK
Route::get('/bank', 'BankController@index')->name('bank.index');
Route::get('/bank/tambah_bank', 'BankController@tambah_bank')->name('bank.tambah_bank');
Route::post('/bank/store_bank', 'BankController@store_bank')->name('bank.store_bank');
Route::get('/bank/edit_bank/{id}', 'BankController@edit_bank')->name('bank.edit_bank');
Route::post('/bank/update_bank', 'BankController@update_bank')->name('bank.update_bank');
Route::get('/bank/hapus_bank/{id}', 'BankController@hapus_bank')->name('bank.hapus_bank');

//DATA TAGIHAN
Route::get('/tagihan', 'TagihanController@index')->name('tagihan.index');
Route::get('/tagihan/tambah_tagihan', 'TagihanController@tambah_tagihan')->name('tagihan.tambah_tagihan');
Route::post('/tagihan/store_tagihan', 'TagihanController@store_tagihan')->name('tagihan.store_tagihan');
Route::get('/tagihan/edit_tagihan/{id}', 'TagihanController@edit_tagihan')->name('tagihan.edit_tagihan');
Route::post('/tagihan/update_tagihan', 'TagihanController@update_tagihan')->name('tagihan.update_tagihan');
Route::get('/tagihan/hapus_tagihan/{id}', 'TagihanController@hapus_tagihan')->name('tagihan.hapus_tagihan');

//DATA DAFTAR BANK
Route::get('/daftar_pelanggan/daftar_bank', 'DaftarPelangganController@daftar_bank')->name('daftar_pelanggan.daftar_bank');
Route::get('/daftar_pelanggan/edit_daftar_bank/{id}', 'DaftarPelangganController@edit_daftar_bank')->name('daftar_pelanggan.edit_daftar_bank');
Route::post('/daftar_pelanggan/update_daftar_bank', 'DaftarPelangganController@update_daftar_bank')->name('daftar_pelanggan.update_daftar_bank');
Route::get('/daftar_pelanggan/hapus_daftar_bank/{id}', 'DaftarPelangganController@hapus_daftar_bank')->name('daftar_pelanggan.hapus_daftar_bank');

//DATA DAFTAR TAGIHAN
Route::get('/daftar_pelanggan/daftar_tagihan', 'DaftarPelangganController@daftar_tagihan')->name('daftar_pelanggan.daftar_tagihan');
Route::get('/daftar_pelanggan/edit_daftar_tagihan/{id}', 'DaftarPelangganController@edit_daftar_tagihan')->name('daftar_pelanggan.edit_daftar_tagihan');
Route::post('/daftar_pelanggan/update_daftar_tagihan', 'DaftarPelangganController@update_daftar_tagihan')->name('daftar_pelanggan.update_daftar_tagihan');
Route::get('/daftar_pelanggan/hapus_daftar_tagihan/{id}', 'DaftarPelangganController@hapus_daftar_tagihan')->name('daftar_pelanggan.hapus_daftar_tagihan');

//DATA RIWAYAT TRANSAKSI
Route::get('/transaksi/riwayat_transfer/{cabang_id}', 'TransaksiController@riwayat_transfer')->name('transaksi.riwayat_transfer');
Route::get('/transaksi/riwayat_tarik_tunai/{cabang_id}', 'TransaksiController@riwayat_tarik_tunai')->name('transaksi.riwayat_tarik_tunai');
Route::get('/transaksi/riwayat_tagihan/{cabang_id}', 'TransaksiController@riwayat_tagihan')->name('transaksi.riwayat_tagihan');
Route::get('/transaksi/update_status_transfer/{nomor_pesanan}', 'TransaksiController@update_status_transfer')->name('transaksi.update_status_transfer');
Route::get('/transaksi/update_status_tarik_tunai/{nomor_pesanan}', 'TransaksiController@update_status_tarik_tunai')->name('transaksi.update_status_tarik_tunai');
Route::get('/transaksi/update_status_tagihan/{nomor_pesanan}', 'TransaksiController@update_status_tagihan')->name('transaksi.update_status_tagihan');
Route::get('/transaksi/cetak_invoice_transfer/{nomor_pesanan}', 'TransaksiController@cetak_invoice_transfer')->name('transaksi.cetak_invoice_transfer');
Route::get('/transaksi/cetak_invoice_tarik_tunai/{nomor_pesanan}', 'TransaksiController@cetak_invoice_tarik_tunai')->name('transaksi.cetak_invoice_tarik_tunai');
Route::get('/transaksi/cetak_invoice_tagihan/{nomor_pesanan}', 'TransaksiController@cetak_invoice_tagihan')->name('transaksi.cetak_invoice_tagihan');

Route::get('/transaksi/cetak_riwayat_transaksi_transfer/{cabang_id}/{filter_bank}/{filter_tgl}/{filter_search}/{filter_status}', 'TransaksiController@cetak_riwayat_transaksi_transfer')->name('transaksi.cetak_riwayat_transaksi_transfer');
Route::get('/transaksi/cetak_laporan_transaksi_tarik_tunai/{cabang_id}/{filter_bank}/{filter_tgl}/{filter_search}/{filter_status}', 'TransaksiController@cetak_riwayat_transaksi_tarik_tunai')->name('transaksi.cetak_riwayat_transaksi_tarik_tunai');
Route::get('/transaksi/cetak_laporan_transaksi_tagihan/{cabang_id}/{filter_bank}/{filter_tgl}/{filter_search}/{filter_status}', 'Transaksi@cetak_riwayat_transaksi_tagihan')->name('transaksi.cetak_riwayat_transaksi_tagihan');

//DATA LAPORAN
Route::get('/laporan/transaksi_transfer', 'LaporanController@transaksi_transfer')->name('laporan.transaksi_transfer');
Route::get('/laporan/transaksi_tarik_tunai', 'LaporanController@transaksi_tarik_tunai')->name('laporan.transaksi_tarik_tunai');
Route::get('/laporan/transaksi_tagihan', 'LaporanController@transaksi_tagihan')->name('laporan.transaksi_tagihan');

Route::get('/laporan/cetak_laporan_transaksi_transfer/{filter_bank}/{filter_tgl}/{filter_search}', 'LaporanController@cetak_laporan_transaksi_transfer')->name('laporan.cetak_laporan_transaksi_transfer');
Route::get('/laporan/cetak_laporan_transaksi_tarik_tunai/{filter_bank}/{filter_tgl}/{filter_search}', 'LaporanController@cetak_laporan_transaksi_tarik_tunai')->name('laporan.cetak_laporan_transaksi_tarik_tunai');
Route::get('/laporan/cetak_laporan_transaksi_tagihan/{filter_bank}/{filter_tgl}/{filter_search}', 'LaporanController@cetak_laporan_transaksi_tagihan')->name('laporan.cetak_laporan_transaksi_tagihan');

//DATA STAFF
Route::get('/staff/daftar_staff', 'StaffController@daftar_staff')->name('staff.daftar_staff');
Route::get('/staff/tambah_staff', 'StaffController@tambah_staff')->name('staff.tambah_staff');
Route::post('/staff/store_staff', 'StaffController@store_staff')->name('staff.store_staff');
Route::get('/staff/edit_staff/{id}', 'StaffController@edit_staff')->name('staff.edit_staff');
Route::post('/staff/update_staff/{id}', 'StaffController@update_staff')->name('staff.update_staff');
Route::get('/staff/hapus_staff/{id}', 'StaffController@hapus_staff')->name('staff.hapus_staff');

//DATA ROLE
Route::get('/role/daftar_role', 'RoleController@daftar_role')->name('role.daftar_role');
Route::get('/role/tambah_role', 'RoleController@tambah_role')->name('role.tambah_role');
Route::post('/role/store_role', 'RoleController@store_role')->name('role.store_role');
Route::get('/role/edit_role/{id}', 'RoleController@edit_role')->name('role.edit_role');
Route::post('/role/update_role/{id}', 'RoleController@update_role')->name('role.update_role');
Route::get('/role/hapus_role/{id}', 'RoleController@hapus_role')->name('role.hapus_role');

//DATA CABANG
Route::get('/cabang/daftar_cabang', 'CabangController@daftar_cabang')->name('cabang.daftar_cabang');
Route::get('/cabang/tambah_cabang', 'CabangController@tambah_cabang')->name('cabang.tambah_cabang');
Route::post('/cabang/store_cabang', 'CabangController@store_cabang')->name('cabang.store_cabang');
Route::get('/cabang/edit_cabang/{id}', 'CabangController@edit_cabang')->name('cabang.edit_cabang');
Route::post('/cabang/update_cabang/{id}', 'CabangController@update_cabang')->name('cabang.update_cabang');
Route::get('/cabang/hapus_cabang/{id}', 'CabangController@hapus_cabang')->name('cabang.hapus_cabang');
Route::get('/cabang/getDataProvinsi', 'CabangController@getDataProvinsi')->name('cabang.provinsi');
Route::get('/cabang/getDataKota', 'CabangController@getDataKota')->name('cabang.kota');

Route::get('/cabang/transaksi_transfer/{id}', 'LaporanController@transaksi_transfer')->name('cabang.transaksi_transfer');
Route::get('/cabang/transaksi_tarik_tunai/{id}', 'LaporanController@transaksi_tarik_tunai')->name('cabang.transaksi_tarik_tunai');
Route::get('/cabang/transaksi_tagihan/{id}', 'LaporanController@transaksi_tagihan')->name('cabang.transaksi_tagihan');

});

