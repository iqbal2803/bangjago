<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan_Pelanggan extends Model
{
	protected $fillable = ['id_jenis_tagihan','nomor_id','nama_pemilik'];
    protected $table = 'tagihan_pelanggan';
}
