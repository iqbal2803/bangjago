<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Tagihan;
use App\Models\TagihanPelanggan;
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

            return response()->json([
                "error" => false,
                "data" => [
                    "tagihan" => $tagihan,
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

    public function getTagihanPelanggan(Request $request)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
            $nomor_id = $request->get('nomor_id');

            $tagihan = TagihanPelanggan::where('nomor_id',$nomor_id)->first;

            return response()->json([
                "error" => false,
                "nomor_id" => $tagihan->nomor_id,
                "nama_pemilik" => $bank->nama_pemilik
                
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
