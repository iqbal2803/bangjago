<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Bank;
use App\Models\Cabang;
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
    public function transaksi_transfer()
    {
        $data['databank'] = Bank::all();
        $data['transaksi'] = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','transfer')->where('status','Selesai')->get();
        return view('laporan.laporan_transfer',$data);
    }

    public function transaksi_tarik_tunai()
    {
        $data['databank'] = Bank::all();
        $data['transaksi'] = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','tarik tunai')->where('status','Selesai')->get();
        return view('laporan.laporan_tarik_tunai',$data);
    }

    public function transaksi_tagihan()
    {
        $data['datatagihan'] = Tagihan::all();
        $data['transaksi'] = Transaksi_Tagihan::where('cabang_id',Auth::user()->cabang->id)->where('status','Selesai')->get();
        return view('laporan.laporan_tagihan',$data);
    }

    public function cetak_laporan_transaksi_transfer($filter_bank,$filter_tgl,$filter_search)
    {   

        $transaksi;
        if($filter_tgl=="null" && $filter_search=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','transfer')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank);
        }else if($filter_search=="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','transfer')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
        }else if($filter_tgl=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','transfer')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank);

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });

        }else{
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','transfer')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });

        }

        $data['cabang']=Cabang::where('users_id',Auth::user()->id)->first();
        $data['transaksi'] = $transaksi->get();

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_transfer',$data);
        
        return $pdf->download('Cetak Laporan Transfer.pdf');
    }

    public function cetak_laporan_transaksi_tarik_tunai($filter_bank,$filter_tgl,$filter_search)
    {   

        $transaksi;
        if($filter_tgl=="null" && $filter_search=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','tarik tunai')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank);
        }else if($filter_search=="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','tarik tunai')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
        }else if($filter_tgl=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','tarik tunai')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank);

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }else{
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi = Transaksi_Bank::where('cabang_id',Auth::user()->cabang->id)->where('jenis_transaksi','tarik tunai')
                        ->where('status','Selesai')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }

        $data['cabang']=Cabang::where('users_id',Auth::user()->id)->first();
        $data['transaksi'] = $transaksi->get();

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_tarik_tunai',$data);
        
        return $pdf->download('Cetak Laporan Tarik Tunai.pdf');
    }

    public function cetak_laporan_transaksi_tagihan($filter_tagihan,$filter_tgl,$filter_search)
    {   

        $transaksi;
        if($filter_tgl=="null" && $filter_search=="null"){
            $transaksi = Transaksi_Tagihan::where('cabang_id',Auth::user()->cabang->id)->where('status','Selesai')
                        ->where('jenis_tagihan',$filter_tagihan);
        }else if($filter_search=="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi = Transaksi_Tagihan::where('cabang_id',Auth::user()->cabang->id)->where('status','Selesai')
                        ->where('jenis_tagihan',$filter_tagihan)
                        ->where('created_at','LIKE','%'.$new_date.'%');
        }else if($filter_tgl=="null"){
            $transaksi = Transaksi_Tagihan::where('cabang_id',Auth::user()->cabang->id)->where('status','Selesai')
                        ->where('jenis_tagihan',$filter_tagihan);

            $columns = ['nomor_id', 'nama_pemilik','nominal_tagihan','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }else{
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            $transaksi = Transaksi_Tagihan::where('cabang_id',Auth::user()->cabang->id)->where('status','Selesai')
                        ->where('jenis_tagihan',$filter_tagihan)
                        ->where('created_at','LIKE','%'.$new_date.'%');

            $columns = ['nomor_id', 'nama_pemilik','nominal_tagihan','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }

        $data['cabang']=Cabang::where('users_id',Auth::user()->id)->first();
        $data['transaksi'] = $transaksi->get();

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_tagihan',$data);
        
        return $pdf->download('Cetak Laporan Tagihan.pdf');
    }

}
