<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Bank;
use App\Models\Bank_Ongkos;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CoreComponentRepository;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::all();
        $data['banks'] = $bank;
        return view('bank.index',$data);
    }

    public function tambah_bank()
    {
        return view('bank.tambah_bank');
    }

    /**
     * Store a newly created resource in storage.
     *test
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_bank(Request $request)
    {
        $bank = new Bank;

        $imgName="";
        if ($request->hasFile('logo_bank')) {
            if($request->file('logo_bank')->getSize()>config('app.max_img_size')){
                return redirect()->back()->with('info', config('app.message_max_img_size'));
            }

            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_bank')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_bank')->getRealPath());
            $img->save(public_path('assets_admin/images/bank/'. $imgName));
            $bank->logo_bank = $imgName;
        }else{
            return back();
        } 
    
        $bank->nama_bank =  $request->nama_bank;
        $bank->jenis_bank =  $request->jenis_bank;
        $bank->save();
        
        return redirect('bank')->with('message', 'Bank has been insert successfully!');
    }

    public function edit_bank($id)
    {
        $data['bank'] = Bank::where('id',$id)->first();
        return view('bank.edit_bank',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_bank(Request $request)
    {
        $bank = Bank::where('id',$request->id_bank)->first();

        $imgName="";
        if ($request->hasFile('logo_bank')) {
            if($request->file('logo_bank')->getSize()>config('app.max_img_size')){
                return redirect()->back()->with('info', config('app.message_max_img_size'));
            }
            
            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_bank')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_bank')->getRealPath());
            $img->save(public_path('assets_admin/images/bank/'. $imgName));
            $bank->logo_bank = $imgName;
        }
    
        $bank->nama_bank =  $request->nama_bank;
        $bank->jenis_bank =  $request->jenis_bank;
        $bank->save();
        
        return redirect('bank')->with('message', 'Bank has been updated successfully!');
    }

    public function hapus_bank($id)
    {
        if(Bank::destroy($id)){
            return redirect('bank')->with('message', 'Bank has been deleted successfully!');
        }else{
            return redirect('bank')->with('danger', 'Something went wrong!');
        }
    }
    
    // ONGKOS TRANSFER

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ongkos_transfer()
    {
        $bank = Bank_Ongkos::where('jenis_transaksi','transfer')->orderBy('nominal_awal')->get();
        $data['dt_ongkos'] = $bank;
        return view('bank.ongkos_transfer',$data);
    }

    public function tambah_ongkos_transfer()
    {
        return view('bank.tambah_ongkos_transfer');
    }

    /**
     * Store a newly created resource in storage.
     *test
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_ongkos_transfer(Request $request)
    {
        $ongkos = new Bank_Ongkos;
        $ongkos->jenis_transaksi =  "transfer";
        $ongkos->nominal_awal =  $request->nominal_awal;
        $ongkos->nominal_akhir =  $request->nominal_akhir;
        $ongkos->ongkos_sesama_bank =  $request->ongkos_sesama_bank;
        $ongkos->ongkos_antar_bank =  $request->ongkos_antar_bank;
        $ongkos->save();
        
        return redirect('bank/ongkos_transfer')->with('message', 'Ongkos Transfer has been insert successfully!');
    }

    public function edit_ongkos_transfer($id)
    {
        $data['ongkos'] = Bank_Ongkos::where('id',$id)->first();
        return view('bank.edit_ongkos_transfer',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_ongkos_transfer(Request $request)
    {
        $ongkos = Bank_Ongkos::where('id',$request->id_ongkos)->first();
        $ongkos->jenis_transaksi =  "transfer";
        $ongkos->nominal_awal =  $request->nominal_awal;
        $ongkos->nominal_akhir =  $request->nominal_akhir;
        $ongkos->ongkos_sesama_bank =  $request->ongkos_sesama_bank;
        $ongkos->ongkos_antar_bank =  $request->ongkos_antar_bank;
        $ongkos->save();
        
        return redirect('bank/ongkos_transfer')->with('message', 'Ongkos Transfer has been updated successfully!');
    }

    public function hapus_ongkos_transfer($id)
    {
        if(Bank_Ongkos::destroy($id)){
            return redirect('bank/ongkos_transfer')->with('message', 'Ongkos Transfer has been deleted successfully!');
        }else{
            return redirect('bank/ongkos_transfer')->with('danger', 'Something went wrong!');
        }
    }

    // ONGKOS TARIK TUNAI

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ongkos_tarik_tunai()
    {
        $bank = Bank_Ongkos::where('jenis_transaksi','tarik tunai')->orderBy('nominal_awal')->get();
        $data['dt_ongkos'] = $bank;
        return view('bank.ongkos_tarik_tunai',$data);
    }

    public function tambah_ongkos_tarik_tunai()
    {
        return view('bank.tambah_ongkos_tarik_tunai');
    }

    /**
     * Store a newly created resource in storage.
     *test
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_ongkos_tarik_tunai(Request $request)
    {
        $ongkos = new Bank_Ongkos;
        $ongkos->jenis_transaksi =  "tarik tunai";
        $ongkos->nominal_awal =  $request->nominal_awal;
        $ongkos->nominal_akhir =  $request->nominal_akhir;
        $ongkos->ongkos_sesama_bank =  $request->ongkos_sesama_bank;
        $ongkos->ongkos_antar_bank =  $request->ongkos_antar_bank;
        $ongkos->save();
        
        return redirect('bank/ongkos_tarik_tunai')->with('message', 'Ongkos Tarik Tunai has been insert successfully!');
    }

    public function edit_ongkos_tarik_tunai($id)
    {
        $data['ongkos'] = Bank_Ongkos::where('id',$id)->first();
        return view('bank.edit_ongkos_tarik_tunai',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_ongkos_tarik_tunai(Request $request)
    {
        $ongkos = Bank_Ongkos::where('id',$request->id_ongkos)->first();
        $ongkos->jenis_transaksi =  "tarik tunai";
        $ongkos->nominal_awal =  $request->nominal_awal;
        $ongkos->nominal_akhir =  $request->nominal_akhir;
        $ongkos->ongkos_sesama_bank =  $request->ongkos_sesama_bank;
        $ongkos->ongkos_antar_bank =  $request->ongkos_antar_bank;
        $ongkos->save();
        
        return redirect('bank/ongkos_tarik_tunai')->with('message', 'Ongkos Tarik Tunai has been updated successfully!');
    }

    public function hapus_ongkos_tarik_tunai($id)
    {
        if(Bank_Ongkos::destroy($id)){
            return redirect('bank/ongkos_tarik_tunai')->with('message', 'Ongkos Tarik Tunai has been deleted successfully!');
        }else{
            return redirect('bank/ongkos_tarik_tunai')->with('danger', 'Something went wrong!');
        }
    }
}
