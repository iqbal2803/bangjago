<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Bank_Pelanggan;
use App\Models\Tagihan_Pelanggan;
use Illuminate\Http\Request;
// use JWTAuth;
// use Tymon\JWTAuth\Exceptions\JWTException;
use CoreComponentRepository;

class RegistrasiController extends Controller
{
    public function createBankPelanggan(Request $request)
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

            Bank_Pelanggan::create($this->setRequest($request, $user));

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

    public function createTagihanPelanggan(Request $request)
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

            Tagihan_Pelanggan::create($this->setRequest($request, $user));

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
