<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace' => 'api'], function () {

	Route::group(['prefix' => 'auth'], function () {
		Route::post('login', 'AuthController@login');
	    Route::post('logout', 'AuthController@logout');
	    Route::post('refresh', 'AuthController@refresh');
	    Route::get('me', 'AuthController@me');
	});

	Route::group(['middleware' => 'jwt.verify'], function () {
		
		Route::group(['prefix' => 'bank'], function () {
			Route::get('getBank', 'BankController@getBank');
			Route::get('getBankPelanggan', 'BankController@getBankPelanggan');
			Route::post('getOngkosTransferBank', 'BankController@getOngkosTransferBank');
			Route::post('getOngkosTarikTunaiBank', 'BankController@getOngkosTarikTunaiBank');
		});

		Route::group(['prefix' => 'tagihan'], function () {
			Route::get('getTagihan', 'TagihanController@getTagihan');
			Route::get('getTagihanPelanggan', 'TagihanController@getTagihanPelanggan');
			Route::post('getOngkosTagihan', 'TagihanController@getOngkosTagihan');
		});

		Route::group(['prefix' => 'registrasi'], function () {
			Route::post('bank_pelanggan', 'RegistrasiController@createBankPelanggan');
			Route::post('tagihan_pelanggan', 'RegistrasiController@createTagihanPelanggan');
		});

		Route::group(['prefix' => 'transaksi'], function () {
			Route::get('getNomorTransaksi', 'TransaksiController@getNomorTransaksi');
			Route::post('transfer_uang', 'TransaksiController@createTransaksiTransferUang');
			Route::post('tarik_tunai', 'TransaksiController@createTransaksiPenarikanTunai');
			Route::post('bayar_tagihan', 'TransaksiController@createTransaksiBayarTagihan');
		});
	});




});