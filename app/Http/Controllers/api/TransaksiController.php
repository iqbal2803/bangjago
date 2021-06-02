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
    
    public function getTransaksiBankByNomorTransaksi(Request $request)
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $transaksi = Transaksi_Bank::where('nomor_transaksi',$request->get('nomor_transaksi'))->get();
            $arrResult = [];

            foreach ($transaksi as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'cabang_id' => $item->cabang_id,
                    'jenis_transaksi' => $item->jenis_transaksi,
                    'nomor_transaksi' => $item->nomor_transaksi,
                    'nama_bank' => $item->nama_bank,
                    'nomor_rekening' => $item->nomor_rekening,
                    'nama_pemilik' => $item->nama_pemilik,
                    'nominal_transfer' => $item->nominal_transfer,
                    'biaya_ongkos' => $item->biaya_ongkos,
                    'total' => $item->total,
                    'status' => $item->status,
                    'berita' => $item->berita,
                    'created_at' => hari_tanggal_jam_indonesia(\Carbon\Carbon::parse($item->created_at)->format('Y-m-d-H:i')),
                    'updated_at' => hari_tanggal_jam_indonesia(\Carbon\Carbon::parse($item->updated_at)->format('Y-m-d-H:i'))
                ];

                array_push($arrResult, $arrayToPush);
            }

            return response()->json([
                "error" => false,
                "data" => [
                    "transaksi" => $arrResult,
                ]
            ]);

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }
        
    }

    public function getTransaksiTagihanByNomorTransaksi(Request $request)
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $transaksi = Transaksi_Tagihan::where('nomor_transaksi',$request->get('nomor_transaksi'))->get();
            $arrResult = [];

            foreach ($transaksi as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'cabang_id' => $item->cabang_id,
                    'nomor_transaksi' => $item->nomor_transaksi,
                    'jenis_tagihan' => $item->jenis_tagihan,
                    'nomor_id' => $item->nomor_id,
                    'nama_pemilik' => $item->nama_pemilik,
                    'nominal_tagihan' => $item->nominal_tagihan,
                    'biaya_ongkos' => $item->biaya_ongkos,
                    'total' => $item->total,
                    'status' => $item->status,
                    'created_at' => hari_tanggal_jam_indonesia(\Carbon\Carbon::parse($item->created_at)->format('Y-m-d-H:i')),
                    'updated_at' => hari_tanggal_jam_indonesia(\Carbon\Carbon::parse($item->updated_at)->format('Y-m-d-H:i'))
                ];

                array_push($arrResult, $arrayToPush);
            }

            return response()->json([
                "error" => false,
                "data" => [
                    "transaksi" => $arrResult,
                ]
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
