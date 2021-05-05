<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';

    public function getUser(){
    	return $this->belongsto(User::class, 'users_id');
    }
}
