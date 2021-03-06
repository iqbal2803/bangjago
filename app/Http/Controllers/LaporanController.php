<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Bank;
use App\Models\Cabang;
use App\Models\Profil;
use App\Models\Role;
use App\Models\Tagihan;
use App\Models\Transaksi_Bank;
use App\Models\Transaksi_Tagihan;
use Illuminate\Http\Request;
use Auth;
use Session;
use PDF;
use CoreComponentRepository;

class LaporanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaksi()
    {
        $data['databank'] = Bank::all();
        $data['datatagihan'] = Tagihan::all();
        if(Auth::user()->role->nama_role=='Admin Cabang'){
        $data['transaksi'] = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('status','Selesai')->OrderBy('created_at','desc')->get();
        }else{
        $data['transaksi']=[];
        }
        return view('laporan.laporan_transaksi',$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaksi_transfer()
    {
        $data['databank'] = Bank::all();
        if(Auth::user()->role->nama_role=='Admin Cabang'){
        $data['transaksi'] = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','transfer')->where('status','Selesai')->OrderBy('created_at','desc')->get();
        }else{
        $data['transaksi']=[];
        }
        return view('laporan.laporan_transfer',$data);
    }

    public function transaksi_tarik_tunai()
    {
        $data['databank'] = Bank::all();
        if(Auth::user()->role->nama_role=='Admin Cabang'){
        $data['transaksi'] = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','tarik tunai')->where('status','Selesai')->OrderBy('created_at','desc')->get();
        }else{
        $data['transaksi']=[];
        }
        return view('laporan.laporan_tarik_tunai',$data);
    }

    public function transaksi_tagihan()
    {
        $data['datatagihan'] = Tagihan::all();
        if(Auth::user()->role->nama_role=='Admin Cabang'){
        $data['transaksi'] = Transaksi_Tagihan::where('cabang_id',Auth::user()->cabang->id)->where('status','Selesai')->OrderBy('created_at','desc')->get();
        }else{
        $data['transaksi']=[];
        }
        return view('laporan.laporan_tagihan',$data);
    }

    public function cetak_laporan_transaksi($filter_jenis_transaksi,$filter_bank,$filter_tgl,$filter_search)
    {   
        if($filter_jenis_transaksi=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id);
        }else{
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi',$filter_jenis_transaksi);
        }
        if($filter_bank!="null"){
            $transaksi->where('nama_bank',$filter_bank);
         }

         if($filter_tgl!="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi->where('created_at','LIKE','%'.$new_date.'%');
         }

         if($filter_search!="null"){
            $replace_search = str_replace(".","",$filter_search);
            if(is_numeric($replace_search)==1){
                $filter_search = $replace_search;
            }

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
         }
        
        $data['jenis_transaksi'] = $filter_jenis_transaksi;
        $data['cabang']=Cabang::where('users_id',Auth::user()->id)->first();
        $data['transaksi'] = $transaksi->where('status','Selesai')->OrderBy('created_at','desc')->get();
        $profil = Profil::where('id',1)->first();
        if($profil==null){
            $data['profile'] =(object)[
                'id' => "",
                'alamat' => "",
                'logo_profil' => "",
                'hubungi_kami' => "",
                'sms' => "",
                'email' => ""
            ];
        }else{
            $data['profile'] = $profil;
        }

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_transaksi',$data)->setPaper('a4', 'landscape');
        
        return $pdf->download('Cetak Laporan Transaksi.pdf');
    }

    public function cetak_laporan_transaksi_transfer($filter_bank,$filter_tgl,$filter_search)
    {   

        $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','transfer');

        if($filter_bank!="null"){
            $transaksi->where('nama_bank',$filter_bank);
         }

         if($filter_tgl!="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi->where('created_at','LIKE','%'.$new_date.'%');
         }

         if($filter_search!="null"){
            $replace_search = str_replace(".","",$filter_search);
            if(is_numeric($replace_search)==1){
                $filter_search = $replace_search;
            }

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
         }
        

        $data['cabang']=Cabang::where('users_id',Auth::user()->id)->first();
        $data['transaksi'] = $transaksi->where('status','Selesai')->OrderBy('created_at','desc')->get();
        $profil = Profil::where('id',1)->first();
        if($profil==null){
            $data['profile'] =(object)[
                'id' => "",
                'alamat' => "",
                'logo_profil' => "",
                'hubungi_kami' => "",
                'sms' => "",
                'email' => ""
            ];
        }else{
            $data['profile'] = $profil;
        }

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_transfer',$data)->setPaper('a4', 'landscape');
        
        return $pdf->download('Cetak Laporan Transfer.pdf');
    }

    public function cetak_laporan_transaksi_tarik_tunai($filter_bank,$filter_tgl,$filter_search)
    {   

        $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','tarik tunai');

        if($filter_bank!="null"){
            $transaksi->where('nama_bank',$filter_bank);
         }

         if($filter_tgl!="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi->where('created_at','LIKE','%'.$new_date.'%');
         }

         if($filter_search!="null"){
            $replace_search = str_replace(".","",$filter_search);
            if(is_numeric($replace_search)==1){
                $filter_search = $replace_search;
            }

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
         }


        $data['cabang']=Cabang::where('users_id',Auth::user()->id)->first();
        $data['transaksi'] = $transaksi->where('status','Selesai')->OrderBy('created_at','desc')->get();
        $profil = Profil::where('id',1)->first();
        if($profil==null){
            $data['profile'] =(object)[
                'id' => "",
                'alamat' => "",
                'logo_profil' => "",
                'hubungi_kami' => "",
                'sms' => "",
                'email' => ""
            ];
        }else{
            $data['profile'] = $profil;
        }

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_tarik_tunai',$data)->setPaper('a4', 'landscape');
        
        return $pdf->download('Cetak Laporan Tarik Tunai.pdf');
    }

    public function cetak_laporan_transaksi_tagihan($filter_tagihan,$filter_tgl,$filter_search)
    {   

        $transaksi = Transaksi_Tagihan::where('cabang_id',Auth::user()->cabang->id);

         if($filter_tagihan!="null"){
            $transaksi->where('jenis_tagihan',$filter_tagihan);
         }

         if($filter_tgl!="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi->where('created_at','LIKE','%'.$new_date.'%');
         }

         if($filter_search!="null"){
            $replace_search = str_replace(".","",$filter_search);
            if(is_numeric($replace_search)==1){
                $filter_search = $replace_search;
            }
            
            $columns = ['nomor_id', 'nama_pemilik','nominal_tagihan','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
         }

        $data['cabang']=Cabang::where('users_id',Auth::user()->id)->first();
        $data['transaksi'] = $transaksi->where('status','Selesai')->OrderBy('created_at','desc')->get();
        $profil = Profil::where('id',1)->first();
        if($profil==null){
            $data['profile'] =(object)[
                'id' => "",
                'alamat' => "",
                'logo_profil' => "",
                'hubungi_kami' => "",
                'sms' => "",
                'email' => ""
            ];
        }else{
            $data['profile'] = $profil;
        }

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_tagihan',$data)->setPaper('a4', 'landscape');
        
        return $pdf->download('Cetak Laporan Tagihan.pdf');
    }

}
