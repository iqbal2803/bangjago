<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Cabang;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Transaksi_Bank;
use App\Models\Transaksi_Tagihan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CoreComponentRepository;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar_cabang()
    {   
        $cabang = Cabang::join('users as b', 'cabang.users_id', '=', 'b.id')
                                ->select(
                                'cabang.*',
                                'b.name'
                                )
                                ->get();
        $data['cabangs'] = $cabang;
        return view('cabang.index',$data);
    }

    public function tambah_cabang()
    {
        $data['datauserscabang'] = Staff::where('b.nama_role','Admin Cabang')
                                ->join('role as b', 'users.role_id', '=', 'b.id')
                                ->select(
                                'users.*',
                                'b.nama_role'
                                )
                                ->get();
        return view('cabang.tambah_cabang',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_cabang(Request $request)
    {
        $cabang = new Cabang;
    
        $cabang->provinsi_id =  $request->provinsi_id;
        $cabang->kota_id =  $request->kota_id;
        $cabang->nama_cabang =  $request->nama_cabang;
        $cabang->alamat =  $request->alamat;
        $cabang->penanggung_jawab =  $request->penanggung_jawab;
        $cabang->no_telepon_pic =  $request->no_telepon_pic;
        $cabang->jam_operasional =  $request->jam_operasional;
        $cabang->users_id =  $request->users_id;
        $cabang->save();
        
        return redirect('cabang/daftar_cabang')->with('message', 'Cabang has been insert successfully!');
    }

    public function edit_cabang($id)
    {
        $data['datauserscabang'] = Staff::where('b.nama_role','Admin Cabang')
                                ->join('role as b', 'users.role_id', '=', 'b.id')
                                ->select(
                                'users.*',
                                'b.nama_role'
                                )
                                ->orderBy('users.name')
                                ->get();
        $data['cabang'] = Cabang::where('id',$id)->first();
        return view('cabang.edit_cabang',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_cabang(Request $request,$id)
    {
        $cabang = Cabang::where('id',$id)->first(); 
        $cabang->provinsi_id =  $request->provinsi_id;
        $cabang->kota_id =  $request->kota_id;
        $cabang->nama_cabang =  $request->nama_cabang;
        $cabang->alamat =  $request->alamat;
        $cabang->penanggung_jawab =  $request->penanggung_jawab;
        $cabang->no_telepon_pic =  $request->no_telepon_pic;
        $cabang->jam_operasional =  $request->jam_operasional;
        $cabang->users_id =  $request->users_id;
        $cabang->save();
        
        return redirect('cabang/daftar_cabang')->with('message', 'Cabang has been updated successfully!');
    }

    public function hapus_cabang($id)
    {
        if(Cabang::destroy($id)){
            return redirect('cabang/daftar_cabang')->with('message', 'Cabang has been deleted successfully!');
        }else{
            return redirect('cabang/daftar_cabang')->with('danger', 'Something went wrong!');
        }
    }

    public function getDataProvinsi(Request $request)
    {
        try {

            $url = "province";
            $response = AppHelper::request_raja_ongkir($url,"GET","");
            $result =[];
            foreach ($response as $key => $value) {
                # code...
                array_push($result, ['id' => $value->province_id ,'text' => $value->province]);
            }
            return response()->json($result, 200);

        } catch (Exception $e) {
            return  response()->json($response, 500);
        }

    }


    public function getDataKota(Request $request)
    {
        try {

            $url = "city";
            if ($request->id_provinsi) {
                
                $url = $url."?province=".$request->id_provinsi;
            }

            $response = AppHelper::request_raja_ongkir($url,"GET","");
            $result =[];
            foreach ($response as $key => $value) {
                # code...
                array_push($result, ['id' => $value->city_id ,'text' => $value->city_name]);
            }
            
            return response()->json($result, 200);

        } catch (Exception $e) {
            return  response()->json($response, 500);
        }

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaksi_transfer($id)
    {
        $data['transaksi'] = Transaksi_Bank::where('jenis_transaksi','transfer')->where('users_id',$id)->get();
        return view('cabang.laporan_transfer',$data);
    }

    public function transaksi_tarik_tunai($id)
    {
        $data['transaksi'] = Transaksi_Bank::where('jenis_transaksi','tarik tunai')->where('users_id',$id)->get();
        return view('laporan.laporan_tarik_tunai',$data);
    }

    public function transaksi_tagihan($id)
    {
        $data['transaksi'] = Transaksi_Tagihan::where('users_id',$id)->get();
        return view('laporan.laporan_tagihan',$data);
    }
    
}
