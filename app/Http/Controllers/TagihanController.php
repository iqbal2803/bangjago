<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CoreComponentRepository;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagihan = Tagihan::all();
        $data['tagihans'] = $tagihan;
        return view('tagihan.index',$data);
    }

    public function tambah_tagihan()
    {
        return view('tagihan.tambah_tagihan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_tagihan(Request $request)
    {
        $tagihan = new Tagihan;

        $imgName="";
        if ($request->hasFile('logo_tagihan')) {

            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_tagihan')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_tagihan')->getRealPath());
            $img->save(public_path('assets_admin/images/tagihan/'. $imgName));
            $tagihan->logo_tagihan = $imgName;
        }else{
            return back();
        } 
    
        $tagihan->nama_tagihan =  $request->nama_tagihan;
        $tagihan->biaya_tarik_tunai =  $request->biaya_tarik_tunai;
        $tagihan->save();
        
        return redirect('tagihan')->with('message', 'Tagihan has been insert successfully!');
    }

    public function edit_tagihan($id)
    {
        $data['tagihan'] = Tagihan::where('id',$id)->first();
        return view('tagihan.edit_tagihan',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_tagihan(Request $request)
    {
        $tagihan = Tagihan::where('id',$request->id_tagihan)->first();

        $imgName="";
        if ($request->hasFile('logo_tagihan')) {

            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_tagihan')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_tagihan')->getRealPath());
            $img->save(public_path('assets_admin/images/tagihan/'. $imgName));
            $tagihan->logo_tagihan = $imgName;
        }
    
        $tagihan->nama_tagihan =  $request->nama_tagihan;
        $tagihan->biaya_tarik_tunai =  $request->biaya_tarik_tunai;
        $tagihan->save();
        
        return redirect('tagihan')->with('message', 'Tagihan has been updated successfully!');
    }

    public function hapus_tagihan($id)
    {
        if(tagihan::destroy($id)){
            return redirect('tagihan')->with('message', 'Tagihan has been deleted successfully!');
        }else{
            return redirect('tagihan')->with('danger', 'Something went wrong!');
        }
    }
    
}
