<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Bank;
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

            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_bank')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_bank')->getRealPath());
            $img->save(public_path('assets_admin/images/bank/'. $imgName));
            $bank->logo_bank = $imgName;
        }else{
            return back();
        } 
    
        $bank->nama_bank =  $request->nama_bank;
        $bank->biaya_transfer =  $request->biaya_transfer;
        $bank->biaya_tarik_tunai =  $request->biaya_tarik_tunai;
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

            $imgName = 'img-'. time(). '-'. AppHelper::generateToken(8). '.'. $request->file('logo_bank')->getClientOriginalExtension();
            $img = Image::make($request->file('logo_bank')->getRealPath());
            $img->save(public_path('assets_admin/images/bank/'. $imgName));
            $bank->logo_bank = $imgName;
        }
    
        $bank->nama_bank =  $request->nama_bank;
        $bank->biaya_transfer =  $request->biaya_transfer;
        $bank->biaya_tarik_tunai =  $request->biaya_tarik_tunai;
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
    
}
