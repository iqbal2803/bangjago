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
	    Route::post('me', 'AuthController@me');
	});

	Route::group(['middleware' => 'jwt.verify'], function () {
		
		Route::group(['prefix' => 'bank'], function () {
			Route::get('getBank', 'BankController@getBank');
		});

		Route::group(['prefix' => 'tagihan'], function () {
			Route::get('getTagihan', 'TagihanController@getTagihan');
		});

		Route::group(['prefix' => 'registrasi'], function () {
			Route::post('bank_pelanggan', 'TagihanController@createBankPelanggan');
			Route::post('tagihan_pelanggan', 'TagihanController@createTagihanPelanggan');
		});

		Route::group(['prefix' => 'transaksi'], function () {
			Route::post('transfer_uang', 'TagihanController@createTransaksiTransferUang');
			Route::post('tarik_tunai', 'TagihanController@createTransaksiPenarikanTunai');
			Route::post('bayar_tagihan', 'TagihanController@createTransaksiBayarTagihan');
		});
	});




});