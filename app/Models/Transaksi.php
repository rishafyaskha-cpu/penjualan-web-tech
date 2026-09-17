<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_transaksi', 'tanggal', 'total'];

    public function detail_transaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}