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

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function riwayat_transfer($cabang_id)
    {
        $data['cabang_id'] = $cabang_id;
        $data['databank'] = Bank::all();
        $data['transaksi'] = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')->get();
        return view('transaksi.riwayat_transfer',$data);
    }

    public function riwayat_tarik_tunai($cabang_id)
    {
        $data['cabang_id'] = $cabang_id;
        $data['databank'] = Bank::all();
        $data['transaksi'] = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')->get();
        return view('transaksi.riwayat_tarik_tunai',$data);
    }

    public function riwayat_tagihan($cabang_id)
    {
        $data['cabang_id'] = $cabang_id;
        $data['datatagihan'] = Tagihan::all();
        $data['transaksi'] = Transaksi_Tagihan::where('cabang_id',$cabang_id)->get();
        return view('transaksi.riwayat_tagihan',$data);
    }

    public function update_status_transfer($nomor_transaksi)
    {
        $bank = Transaksi_Bank::where('nomor_transaksi',$nomor_transaksi)->first();
        $bank->status =  "Selesai";
        $bank->save();
        
        return redirect('transaksi/riwayat_transfer/'.$bank->cabang_id)->with('message', 'Status has been updated successfully!');
    }

    public function update_status_tarik_tunai($nomor_transaksi)
    {
        $bank = Transaksi_Bank::where('nomor_transaksi',$nomor_transaksi)->first();
        $bank->status =  "Selesai";
        $bank->save();
        
        return redirect('transaksi/riwayat_tarik_tunai/'.$bank->cabang_id)->with('message', 'Status has been updated successfully!');
    }

    public function update_status_tagihan($nomor_transaksi)
    {
        $bank = Transaksi_Tagihan::where('nomor_transaksi',$nomor_transaksi)->first();
        $bank->status =  "Selesai";
        $bank->save();
        
        return redirect('transaksi/riwayat_tagihan/'.$bank->cabang_id)->with('message', 'Status has been updated successfully!');
    }




    public function cetak_invoice_transfer($nomor_transaksi)
    {

    }

    public function cetak_invoice_tarik_tunai($nomor_transaksi)
    {

    }

    public function cetak_invoice_tagihan($nomor_transaksi)
    {

    }

    public function cetak_riwayat_transaksi_transfer($cabang_id,$filter_bank,$filter_tgl,$filter_search,$filter_status)
    {   

        $transaksi;
        if($filter_tgl=="null" && $filter_search=="null"){
            if($filter_status=="null"){
                $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('nama_bank',$filter_bank);
            }else{
                $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank);
            }
        }else if($filter_search=="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            if($filter_status=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }else{
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }
        }else if($filter_tgl=="null"){
            if($filter_status=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('nama_bank',$filter_bank);
            }else{
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank);
            }

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });

        }else{
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            if($filter_status=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }else{
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','transfer')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });

        }

        $data['cabang']=Cabang::where('id',$cabang_id)->first();
        $data['transaksi'] = $transaksi->get();

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('transaksi.cabang_cetak_laporan_transfer',$data);
        
        return $pdf->download('Cetak Laporan Transfer.pdf');
    }

    public function cetak_riwayat_transaksi_tarik_tunai($cabang_id,$filter_bank,$filter_tgl,$filter_search,$filter_status)
    {   

        $transaksi;
        if($filter_tgl=="null" && $filter_search=="null"){
            if($filter_status=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('nama_bank',$filter_bank);
            }else{
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank);
            }
        }else if($filter_search=="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            if($filter_status=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }else{
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }
        }else if($filter_tgl=="null"){
            if($filter_status=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('nama_bank',$filter_bank);
            }else{
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank);
            }

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }else{
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            if($filter_status=="null"){
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }else{
            $transaksi = Transaksi_Bank::where('cabang_id',$cabang_id)->where('jenis_transaksi','tarik tunai')
                        ->where('status',$filter_status)
                        ->where('nama_bank',$filter_bank)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }

            $columns = ['nomor_rekening', 'nama_pemilik','nominal_transfer','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }

        $data['cabang']=Cabang::where('id',$cabang_id)->first();
        $data['transaksi'] = $transaksi->get();

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_tarik_tunai',$data);
        
        return $pdf->download('Cetak Laporan Tarik Tunai.pdf');
    }

    public function cetak_riwayat_transaksi_tagihan($cabang_id,$filter_tagihan,$filter_tgl,$filter_search,$filter_status)
    {   

        $transaksi;
        if($filter_tgl=="null" && $filter_search=="null"){
            if($filter_status=="null"){
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('jenis_tagihan',$filter_tagihan);
            }else{
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('status',$filter_status)
                        ->where('jenis_tagihan',$filter_tagihan);
            }
        }else if($filter_search=="null"){
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            if($filter_status=="null"){
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('jenis_tagihan',$filter_tagihan)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }else{
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('status',$filter_status)
                        ->where('jenis_tagihan',$filter_tagihan)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }
        }else if($filter_tgl=="null"){
            if($filter_status=="null"){
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('jenis_tagihan',$filter_tagihan);
            }else{
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('status',$filter_status)
                        ->where('jenis_tagihan',$filter_tagihan);
            }
            $columns = ['nomor_id', 'nama_pemilik','nominal_tagihan','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }else{
            $new_date = date("Y-m-d", strtotime($filter_tgl));
            if($filter_status=="null"){
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('jenis_tagihan',$filter_tagihan)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }else{
            $transaksi = Transaksi_Tagihan::where('cabang_id',$cabang_id)
                        ->where('status',$filter_status)
                        ->where('jenis_tagihan',$filter_tagihan)
                        ->where('created_at','LIKE','%'.$new_date.'%');
            }
            $columns = ['nomor_id', 'nama_pemilik','nominal_tagihan','biaya_ongkos','total'];

            $transaksi->where(function($q) use($columns,$filter_search) {
                $q->where('nomor_transaksi', 'LIKE','%' . $filter_search . '%');
                foreach ($columns as $column ) {
                $q->orWhere($column, 'LIKE', '%' . $filter_search . '%');
                }
            });
        }

        $data['cabang']=Cabang::where('id',$cabang_id)->first();
        $data['transaksi'] = $transaksi->get();

        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('laporan.cabang_cetak_laporan_tagihan',$data);
        
        return $pdf->download('Cetak Laporan Tagihan.pdf');
    }

}
