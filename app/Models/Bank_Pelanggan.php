<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank_Pelanggan extends Model
{
	protected $fillable = ['id_bank','nomor_rekening','nama_pemilik'];
    protected $table = 'bank_pelanggan';
}
