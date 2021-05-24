<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Bank;
use App\Models\Bank_Pelanggan;
use App\Models\Tagihan;
use App\Models\Tagihan_Pelanggan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CoreComponentRepository;

class DaftarPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar_bank()
    {
        $bank = Bank_Pelanggan::join('bank as b', 'bank_pelanggan.id_bank', '=', 'b.id')
                                ->select(
                                'bank_pelanggan.*',
                                'b.nama_bank'
                                )
                                ->OrderBy('created_at','desc')
                                ->get();
        $data['daftar'] = $bank;
        return view('daftar_pelanggan.bank.index',$data);
    }

    public function edit_daftar_bank($id_daftar)
    {
        $data['databank'] = Bank::all();
        $data['daftar'] = Bank_Pelanggan::where('bank_pelanggan.id',$id_daftar)
                        ->join('bank as b', 'bank_pelanggan.id_bank', '=', 'b.id')
                        ->select(
                        'bank_pelanggan.*',
                        'b.nama_bank'
                        )
                        ->first();
        //print_r($dataa);
        return view('daftar_pelanggan.bank.edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_daftar_bank(Request $request)
    {
        $bank = Bank_Pelanggan::where('id',$request->id_daftar)->first();
        $bank->id_bank =  $request->id_bank;
        $bank->nomor_rekening =  $request->nomor_rekening;
        $bank->nama_pemilik =  $request->nama_pemilik;
        $bank->save();
        
        return redirect('daftar_pelanggan/daftar_bank')->with('message', 'Daftar has been updated successfully!');
    }

    public function hapus_daftar_bank($id_daftar)
    {
        if(Bank_Pelanggan::destroy($id_daftar)){
            return redirect('daftar_pelanggan/daftar_bank')->with('message', 'Daftar has been deleted successfully!');
        }else{
            return redirect('daftar_pelanggan/daftar_bank')->with('danger', 'Something went wrong!');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar_tagihan()
    {
        $tagihan = Tagihan_Pelanggan::join('tagihan as b', 'tagihan_pelanggan.id_jenis_tagihan', '=', 'b.id')
                                ->select(
                                'tagihan_pelanggan.*',
                                'b.nama_tagihan'
                                )
                                ->OrderBy('created_at','desc')
                                ->get();
        $data['daftar'] = $tagihan;
        return view('daftar_pelanggan.tagihan.index',$data);
    }

    public function edit_daftar_tagihan($id_daftar)
    {
        $data['datatagihan'] = Tagihan::all();
        $data['daftar'] = Tagihan_Pelanggan::where('tagihan_pelanggan.id',$id_daftar)
                        ->join('tagihan as b', 'tagihan_pelanggan.id_jenis_tagihan', '=', 'b.id')
                        ->select(
                        'tagihan_pelanggan.*',
                        'b.nama_tagihan'
                        )
                        ->first();
        //print_r($dataa);
        return view('daftar_pelanggan.tagihan.edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_daftar_tagihan(Request $request)
    {
        $tagihan = Tagihan_Pelanggan::where('id',$request->id_daftar)->first();
        $tagihan->id_jenis_tagihan =  $request->id_jenis_tagihan;
        $tagihan->nomor_id =  $request->nomor_id;
        $tagihan->nama_pemilik =  $request->nama_pemilik;
        $tagihan->save();
        
        return redirect('daftar_pelanggan/daftar_tagihan')->with('message', 'Daftar has been updated successfully!');
    }

    public function hapus_daftar_tagihan($id_daftar)
    {
        if(Tagihan_Pelanggan::destroy($id_daftar)){
            return redirect('daftar_pelanggan/daftar_tagihan')->with('message', 'Daftar has been deleted successfully!');
        }else{
            return redirect('daftar_pelanggan/daftar_tagihan')->with('danger', 'Something went wrong!');
        }
    }
    
}
