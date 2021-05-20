<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Bank_Pelanggan;
use App\Models\Tagihan_Pelanggan;
use App\Models\Transaksi_Bank;
use App\Models\Transaksi_Tagihan;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use CoreComponentRepository;

class TransaksiController extends Controller
{

    public function getNomortransaksi()
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            return response()->json([
                "error" => false,
                "nomor_transaksi" => date('Ymd-His').rand(10,99)
            ]);

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }
        
    }

    public function createTransaksiTransferUang(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            // $validator = $this->validateForm($request);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'error' => true,
            //         'data' => [
            //             'message' => $validator->errors()->toJson()
            //         ]
            //     ], 400);
            // }
            $data = [
            'cabang_id' => $request->get('cabang_id'),
            'jenis_transaksi' => 'transfer',
            'nomor_transaksi' => $request->get('nomor_transaksi'),
            'nama_bank' => $request->get('nama_bank'),
            'nomor_rekening' => $request->get('nomor_rekening'),
            'nama_pemilik' => $request->get('nama_pemilik'),
            'nominal_transfer' => $request->get('nominal_transfer'),
            'biaya_ongkos' => $request->get('biaya_ongkos'),
            'total' => $request->get('total'),
            'status' => 'Pending',
            'berita' => $request->get('berita')
            ];

            Transaksi_Bank::create($data);

             return response()->json([
                "error" => false,
                "message" => "Data berhasil dibuat"
            ]);
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }

    public function createTransaksiPenarikanTunai(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            // $validator = $this->validateForm($request);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'error' => true,
            //         'data' => [
            //             'message' => $validator->errors()->toJson()
            //         ]
            //     ], 400);
            // }
            $data = [
            'cabang_id' => $request->get('cabang_id'),
            'jenis_transaksi' => 'tarik tunai',
            'nomor_transaksi' => $request->get('nomor_transaksi'),
            'nama_bank' => $request->get('nama_bank'),
            'nomor_rekening' => $request->get('nomor_rekening'),
            'nama_pemilik' => $request->get('nama_pemilik'),
            'nominal_transfer' => $request->get('nominal_transfer'),
            'biaya_ongkos' => $request->get('biaya_ongkos'),
            'total' => $request->get('total'),
            'status' => 'Pending',
            'berita' => $request->get('berita')
            ];

            Transaksi_Bank::create($data);

             return response()->json([
                "error" => false,
                "message" => "Data berhasil dibuat"
                
            ]);
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }

    public function createTransaksiBayarTagihan(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            // $validator = $this->validateForm($request);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'error' => true,
            //         'data' => [
            //             'message' => $validator->errors()->toJson()
            //         ]
            //     ], 400);
            // }
            $data = [
            'cabang_id' => $request->get('cabang_id'),
            'nomor_transaksi' => $request->get('nomor_transaksi'),
            'jenis_tagihan' => $request->get('jenis_tagihan'),
            'nomor_id' => $request->get('nomor_id'),
            'nama_pemilik' => $request->get('nama_pemilik'),
            'nominal_tagihan' => $request->get('nominal_tagihan'),
            'biaya_ongkos' => $request->get('biaya_ongkos'),
            'total' => $request->get('total'),
            'status' => 'Pending'
            ];

            Transaksi_Tagihan::create($data);

             return response()->json([
                "error" => false,
                "message" => "Data berhasil dibuat"
                
            ]);
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }
    
}
