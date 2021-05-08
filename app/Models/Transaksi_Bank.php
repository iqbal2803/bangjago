<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi_Bank extends Model
{
	protected $fillable = ['cabang_id','jenis_transaksi','nomor_transaksi','nama_bank','nomor_rekening','nama_pemilik','nominal_transfer','biaya_ongkos','total','status'];
    protected $table = 'transaksi_bank';
}
