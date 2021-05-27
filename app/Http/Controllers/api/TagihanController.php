<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Tagihan;
use App\Models\Tagihan_Pelanggan;
use App\Models\Tagihan_Ongkos;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use CoreComponentRepository;

class TagihanController extends Controller
{
    public function getTagihan()
    {    
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $tagihan = Tagihan::all();
            $arrResult = [];

            foreach ($tagihan as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'nama_tagihan' => $item->nama_tagihan,
                    'logo_tagihan' => asset('assets_admin/images/tagihan/'.$item->logo_tagihan),
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];

                array_push($arrResult, $arrayToPush);
            }

            return response()->json([
                "error" => false,
                "data" => [
                    "tagihan" => $arrResult,
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

    public function getTagihanPelanggan()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $tagihan = Tagihan_Pelanggan::join('tagihan as b', 'tagihan_pelanggan.id_jenis_tagihan', '=', 'b.id')
                        ->select(
                        'tagihan_pelanggan.*',
                        'b.nama_tagihan',
                        'b.logo_tagihan'
                        )
                        ->get();
            $arrResult = [];

            foreach ($tagihan as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'id_jenis_tagihan' => $item->id_jenis_tagihan,
                    'nama_tagihan' => $item->nama_tagihan,
                    'nomor_id' => $item->nomor_id,
                    'nama_pemilik' => $item->nama_pemilik,
                    'logo_tagihan' => asset('assets_admin/images/tagihan/'.$item->logo_tagihan),
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];

                array_push($arrResult, $arrayToPush);
            }

            return response()->json([
                "error" => false,
                "data" => [
                    "tagihan" => $arrResult,
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

    public function getOngkosTagihan(Request $request)
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $tagihan = Tagihan_Ongkos::where('tagihan_id',$request->get('tagihan_id'))
                    ->where('nominal_awal','<=',$request->get('nominal'))
                    ->orderBy('nominal_awal','desc')
                    ->limit(1)
                    ->first();
            $arrResult = [];

            if($tagihan!=null || $tagihan!=""){
                if($request->get('nominal')>$tagihan->nominal_akhir){

                return response()->json([
                    "error" => false,
                    "message" => "ongkos tidak ditemukan",
                    "data" => [
                        "tagihan" => $arrResult,
                    ]
                ]);

                }else{

                $arrayToPush = [
                    'id' => $tagihan->id,
                    'tagihan_id' => $tagihan->tagihan_id,
                    'nominal_awal' => $tagihan->nominal_awal,
                    'nominal_akhir' => $tagihan->nominal_akhir,
                    'ongkos_tagihan' => $tagihan->ongkos_tagihan,
                    'created_at' => $tagihan->created_at,
                    'updated_at' => $tagihan->updated_at
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
                        "tagihan" => $arrResult,
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
