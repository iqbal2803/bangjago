<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Tagihan;
use App\Models\Tagihan_Ongkos;
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
            if($request->file('logo_tagihan')->getSize()>config('app.max_img_size')){
                return redirect()->back()->with('info', config('app.message_max_img_size'));
            }

            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_tagihan')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_tagihan')->getRealPath());
            $img->save(public_path('assets_admin/images/tagihan/'. $imgName));
            $tagihan->logo_tagihan = $imgName;
        }else{
            return back();
        } 
    
        $tagihan->nama_tagihan =  $request->nama_tagihan;
        $tagihan->save();

        $jumlah_data=$request->txtCount;
        if($jumlah_data>0){
            for($i=0;$i<$jumlah_data;$i++){

                $tagihan_ongkos = new Tagihan_Ongkos;
                $tagihan_ongkos->tagihan_id =  $tagihan->id;
                $tagihan_ongkos->nominal_awal =  $request->nominal_awal[$i];
                $tagihan_ongkos->nominal_akhir =  $request->nominal_akhir[$i];
                $tagihan_ongkos->ongkos_tagihan = $request->ongkos_tagihan[$i];
                $tagihan_ongkos->save();
            }
        }
        
        return redirect('tagihan')->with('message', 'Tagihan has been insert successfully!');
    }

    public function edit_tagihan($id)
    {
        $data['tagihan'] = Tagihan::where('id',$id)->first();
        $dt_tagihan_ongkos = Tagihan_Ongkos::where('tagihan_id',$id)->get();
        $data['dt_tagihan_ongkos'] = $dt_tagihan_ongkos;
        $data['jumlah_tagihan_ongkos'] = count($dt_tagihan_ongkos);
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
            if($request->file('logo_tagihan')->getSize()>config('app.max_img_size')){
                return redirect()->back()->with('info', config('app.message_max_img_size'));
            }

            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_tagihan')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_tagihan')->getRealPath());
            $img->save(public_path('assets_admin/images/tagihan/'. $imgName));
            $tagihan->logo_tagihan = $imgName;
        }
    
        $tagihan->nama_tagihan =  $request->nama_tagihan;
        $tagihan->save();

        $dt_tagihan=Tagihan_Ongkos::where('tagihan_id',$request->id_tagihan)->get();
        if(count($dt_tagihan)>0){
            Tagihan_Ongkos::where('tagihan_id',$request->id_tagihan)->delete();
        }
            
        $jumlah_data=$request->txtCount;
            if($jumlah_data>0){
                for($i=0;$i<$jumlah_data;$i++){

                    $tagihan_ongkos = new Tagihan_Ongkos;
                    $tagihan_ongkos->tagihan_id =  $request->id_tagihan;
                    $tagihan_ongkos->nominal_awal =  $request->nominal_awal[$i];
                    $tagihan_ongkos->nominal_akhir =  $request->nominal_akhir[$i];
                    $tagihan_ongkos->ongkos_tagihan = $request->ongkos_tagihan[$i];
                    $tagihan_ongkos->save();
                }
            }
        
        
        return redirect('tagihan')->with('message', 'Tagihan has been updated successfully!');
    }

    public function hapus_tagihan($id)
    {
        if(Tagihan::destroy($id)){
            return redirect('tagihan')->with('message', 'Tagihan has been deleted successfully!');
        }else{
            return redirect('tagihan')->with('danger', 'Something went wrong!');
        }
    }
    
}
