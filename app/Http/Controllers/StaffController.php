<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CoreComponentRepository;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar_staff()
    {   
        $staff = User::join('role as b', 'users.role_id', '=', 'b.id')
                                ->select(
                                'users.*',
                                'b.nama_role'
                                )
                                ->get();
        $data['staffs'] = $staff;
        return view('staff.index',$data);
    }

    public function tambah_staff()
    {
        $data['datarole'] = Role::all();
        return view('staff.tambah_staff',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_staff(Request $request)
    {
        $staff = new User;
    
        $staff->name =  $request->nama;
        $staff->email =  $request->email;
        $staff->password =  bcrypt($request->password);
        $staff->no_telepon =  $request->no_telepon;
        $staff->role_id =  $request->role_id;
        $staff->save();
        
        return redirect('staff/daftar_staff')->with('message', 'Staff has been insert successfully!');
    }

    public function edit_staff($id)
    {
        $data['staff'] = User::where('users.id',$id)
                                ->join('role as b', 'users.role_id', '=', 'b.id')
                                ->select(
                                'users.*',
                                'b.nama_role'
                                )
                                ->first();
        $data['datarole'] = Role::all();
        return view('staff.edit_staff',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_staff(Request $request,$id)
    {
        $staff = User::where('id',$id)->first(); 
        $staff->name =  $request->nama;
        $staff->email =  $request->email;
        $staff->password =  bcrypt($request->password);
        $staff->no_telepon =  $request->no_telepon;
        $staff->role_id =  $request->role_id;
        $staff->save();
        
        return redirect('staff/daftar_staff')->with('message', 'Staff has been updated successfully!');
    }

    public function hapus_staff($id)
    {
        if(Staff::destroy($id)){
            return redirect('staff/daftar_staff')->with('message', 'Staff has been deleted successfully!');
        }else{
            return redirect('staff/daftar_staff')->with('danger', 'Something went wrong!');
        }
    }
    
}
