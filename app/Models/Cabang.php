<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';

    //protected $appends = ['getProvinsi', 'getKota'];

    public function getUser(){
    	return $this->belongsto(User::class, 'users_id');
    }

    public function getProvinsi(){
    	return $this->belongsto(Provinces::class, 'provinsi_id');
    }

    public function getKota(){
    	return $this->belongsto(Cities::class, 'kota_id');
    }
}
