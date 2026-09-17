<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['kode_barang', 'nama_barang', 'harga', 'stok'];

    public function detail_transaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}