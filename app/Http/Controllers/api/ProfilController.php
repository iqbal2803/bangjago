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

            $profil = Profil::where('id',1)->get();
            $arrResult = [];

            foreach ($profil as $item) {
                $arrayToPush = [
                    'id' => $item->id,
                    'nama_aplikasi' => $item->nama_aplikasi,
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
        
    }

}
