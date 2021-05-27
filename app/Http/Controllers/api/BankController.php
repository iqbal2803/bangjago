<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Bank;
use App\Models\Bank_Pelanggan;
use App\Models\Bank_Ongkos;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use CoreComponentRepository;

class BankController extends Controller
{
    public function getBank(Request $request)
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $bank = Bank::where('jenis_bank',$request->get('jenis_bank'))->get();
            $arrResult = [];

            foreach ($bank as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'nama_bank' => $item->nama_bank,
                    'logo_bank' => asset('assets_admin/images/bank/'.$item->logo_bank),
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
                                'b.logo_bank'
                                )
                                ->get();
            $arrResult = [];

            foreach ($bank as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'nama_bank' => $item->nama_bank,
                    'nomor_rekening' => $item->nomor_rekening,
                    'nama_pemilik' => $item->nama_pemilik,
                    'logo_bank' => asset('assets_admin/images/bank/'.$item->logo_bank),
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

    public function getOngkosTransferBank(Request $request)
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $bank = Bank_Ongkos::where('jenis_transaksi','transfer')
                    ->where('nominal_awal','<=',$request->get('nominal'))
                    ->orderBy('nominal_awal','desc')
                    ->limit(1)
                    ->first();
            $arrResult = [];

            // echo $bank->nominal_akhir;
            // return;
            if($bank!=null || $bank!=""){

                if($request->get('nominal')>$bank->nominal_akhir){

                return response()->json([
                    "error" => false,
                    "message" => "ongkos tidak ditemukan",
                    "data" => [
                        "bank" => $arrResult,
                    ]
                ]);

                }else{

                $arrayToPush = [
                    'id' => $bank->id,
                    'jenis_transaksi' => $bank->jenis_transaksi,
                    'nominal_awal' => $bank->nominal_awal,
                    'nominal_akhir' => $bank->nominal_akhir,
                    'ongkos_sesama_bank' => $bank->ongkos_sesama_bank,
                    'ongkos_antar_bank' => $bank->ongkos_antar_bank,
                    'created_at' => $bank->created_at,
                    'updated_at' => $bank->updated_at
                ];

                array_push($arrResult, $arrayToPush);
                

                return response()->json([
                    "error" => false,
                    "message" => "ongkos ditemukan",
                    "data" => [
                        "bank" => $arrResult,
                    ]
                ]);

                }
            }else{
                return response()->json([
                    "error" => false,
                    "message" => "ongkos tidak ditemukan",
                    "data" => [
                        "bank" => $arrResult,
                    ]
                ]);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }
        
    }

    public function getOngkosTarikTunaiBank(Request $request)
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $bank = Bank_Ongkos::where('jenis_transaksi','tarik tunai')
                    ->where('nominal_awal','<=',$request->get('nominal'))
                    ->orderBy('nominal_awal','desc')
                    ->limit(1)
                    ->first();
            $arrResult = [];

            // echo $bank->nominal_akhir;
            // return;
            if($bank!=null || $bank!=""){

                if($request->get('nominal')>$bank->nominal_akhir){

                return response()->json([
                    "error" => false,
                    "message" => "ongkos tidak ditemukan",
                    "data" => [
                        "bank" => $arrResult,
                    ]
                ]);

                }else{

                $arrayToPush = [
                    'id' => $bank->id,
                    'jenis_transaksi' => $bank->jenis_transaksi,
                    'nominal_awal' => $bank->nominal_awal,
                    'nominal_akhir' => $bank->nominal_akhir,
                    'ongkos_sesama_bank' => $bank->ongkos_sesama_bank,
                    'ongkos_antar_bank' => $bank->ongkos_antar_bank,
                    'created_at' => $bank->created_at,
                    'updated_at' => $bank->updated_at
                ];

                array_push($arrResult, $arrayToPush);
                

                return response()->json([
                    "error" => false,
                    "message" => "ongkos ditemukan",
                    "data" => [
                        "bank" => $arrResult,
                    ]
                ]);

                }
            }else{
                return response()->json([
                    "error" => false,
                    "message" => "ongkos tidak ditemukan",
                    "data" => [
                        "bank" => $arrResult,
                    ]
                ]);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }
        
    }

}
