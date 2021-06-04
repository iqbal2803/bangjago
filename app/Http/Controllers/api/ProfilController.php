<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\AppHelper;
use App\Models\Profil;
use App\Models\Bank_Pelanggan;
use App\Models\Bank_Ongkos;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use CoreComponentRepository;

class ProfilController extends Controller
{

    public function getProfil(Request $request)
    {   
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

            $profil = Profil::where('id',1)->get();
            $arrResult = [];

            foreach ($bank as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'logo_profil' => asset('assets_admin/images/profil/'.$item->logo_profil),
                    'alamat' => $item->alamat,
                    'hubungi_kami' => $item->hubungi_kami,
                    'sms' => $item->sms,
                    'email' => $item->email,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];

                array_push($arrResult, $arrayToPush);
            }

            return response()->json([
                "error" => false,
                "data" => [
                    "profil" => $arrResult,
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
