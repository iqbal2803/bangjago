<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Profil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CoreComponentRepository;

class ProfilController extends Controller
{


    public function edit_profil()
    {
        $profil = Profil::where('id',1)->first();
        if($profil==null){
            $data['profil'] =(object)[
                'id' => "",
                'nama_aplikasi' => "",
                'alamat' => "",
                'logo_profil' => "",
                'hubungi_kami' => "",
                'sms' => "",
                'email' => ""
            ];
        }else{
            $data['profil'] = $profil;
            
        }
        return view('profil.edit_profil',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_profil(Request $request)
    {
        if($request->id_profil==""){
            $profil = new Profil;
            $profil->id = 1;
        }else{
            $profil = Profil::where('id',1)->first();
        }

        $imgName="";
        if ($request->hasFile('logo_profil')) {
            if($request->file('logo_profil')->getSize()>config('app.max_img_size')){
                return redirect()->back()->with('info', config('app.message_max_img_size'));
            }
            
            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_profil')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_profil')->getRealPath());
            $img->save(public_path('assets_admin/images/profil/'. $imgName));
            $profil->logo_profil = $imgName;
        }

        $profil->nama_aplikasi =  $request->nama_aplikasi;
        $profil->alamat =  $request->alamat;
        $profil->hubungi_kami =  $request->hubungi_kami;
        $profil->sms =  $request->sms;
        $profil->email =  $request->email;
        $profil->save();
        
        return redirect('profil/edit_profil')->with('message', 'Profil has been updated successfully!');
    }

}
