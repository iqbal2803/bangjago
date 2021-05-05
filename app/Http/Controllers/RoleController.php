<?php

namespace App\Http\Controllers;

use App\AppHelper;
use App\Models\Role;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use CoreComponentRepository;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar_role()
    {
        $role = Role::all();
        $data['roles'] = $role;
        return view('role.index',$data);
    }

    public function tambah_role()
    {
        return view('role.tambah_role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_role(Request $request)
    {
        $role = new Role;
        $role->nama_role =  $request->nama_role;
        $role->permission =  json_encode($request->permission);
        $role->save();
        
        return redirect('role/daftar_role')->with('message', 'Role has been insert successfully!');
    }

    public function edit_role($id)
    {
        $data['role'] = Role::where('id',$id)->first();
        return view('role.edit_role',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_role(Request $request,$id)
    {
        $role = Role::where('id',$id)->first();
        $role->nama_role =  $request->nama_role;
        $role->permission =  json_encode($request->permission);
        $role->save();
        
        return redirect('role/daftar_role')->with('message', 'Role has been updated successfully!');
    }

    public function hapus_role($id)
    {
        if(Role::destroy($id)){
            return redirect('role/daftar_role')->with('message', 'Role has been deleted successfully!');
        }else{
            return redirect('role/daftar_role')->with('danger', 'Something went wrong!');
        }
    }
    
}
