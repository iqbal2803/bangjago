<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Bank;
use App\Models\Bank_Pelanggan;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use CoreComponentRepository;

class BankController extends Controller
{
    public function getBank()
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $bank = Bank::all();
            $arrResult = [];

            foreach ($bank as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'nama_bank' => $item->nama_bank,
                    'logo_bank' => asset('assets_admin/images/bank/'.$item->logo_bank),
                    'biaya_transfer' => $item->biaya_transfer,
                    'biaya_tarik_tunai' => $item->biaya_tarik_tunai,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];

                array_push($arrResult, $arrayToPush);
            }

            return response()->json([
                "error" => false,
                "data" => [
                    "bank" => $arrResult,
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

    public function getBankPelanggan()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
            
            $bank = Bank_Pelanggan::join('bank as b', 'bank_pelanggan.id_bank', '=', 'b.id')
                                ->select(
                                'bank_pelanggan.*',
                                'b.nama_bank',
                                'b.logo_bank',
                                'b.biaya_transfer',
                                'b.biaya_tarik_tunai',
                                )
                                ->get();
            $arrResult = [];

            foreach ($bank as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'nama_bank' => $item->nama_bank,
                    'logo_bank' => asset('assets_admin/images/bank/'.$item->logo_bank),
                    'biaya_transfer' => $item->biaya_transfer,
                    'biaya_tarik_tunai' => $item->biaya_tarik_tunai,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];

                array_push($arrResult, $arrayToPush);
            }

            return response()->json([
                "error" => false,
                "data" => [
                    "bank" => $arrResult,
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
