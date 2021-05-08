<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Bank_Pelanggan;
use App\Models\Tagihan_Pelanggan;
use App\Models\Transaksi_Bank;
use App\Models\Transaksi_Tagihan;
use Illuminate\Http\Request;
// use JWTAuth;
// use Tymon\JWTAuth\Exceptions\JWTException;
use CoreComponentRepository;

class TransaksiController extends Controller
{
    public function createTransaksiTransferUang(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $validator = $this->validateForm($request);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'data' => [
                        'message' => $validator->errors()->toJson()
                    ]
                ], 400);
            }

            Transaksi_Bank::create($this->setRequest($request, $user));

             return response()->json([
                "error" => false,
                "message" => "Data berhasil dibuat",
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

    public function createTransaksiPenarikanTunai(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $validator = $this->validateForm($request);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'data' => [
                        'message' => $validator->errors()->toJson()
                    ]
                ], 400);
            }

            Transaksi_Bank::create($this->setRequest($request, $user));

             return response()->json([
                "error" => false,
                "message" => "Data berhasil dibuat",
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

    public function createTransaksiBayarTagihan(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $validator = $this->validateForm($request);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'data' => [
                        'message' => $validator->errors()->toJson()
                    ]
                ], 400);
            }

            Transaksi_Tagihan::create($this->setRequest($request, $user));

             return response()->json([
                "error" => false,
                "message" => "Data berhasil dibuat",
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
