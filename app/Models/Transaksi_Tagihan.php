<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi_Tagihan extends Model
{
	protected $fillable = ['cabang_id','nomor_transaksi','jenis_tagihan','nomor_id','nama_pemilik','nominal_tagihan','biaya_ongkos','total','status'];
    protected $table = 'transaksi_tagihan';
}
