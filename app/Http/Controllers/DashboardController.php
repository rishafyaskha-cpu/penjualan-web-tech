<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_barang = Barang::count();
        $jumlah_transaksi = Transaksi::count();
        $total_penjualan = Transaksi::sum('total');
        $stok_menipis = Barang::where('stok', '<=', 5)->get();

        return view('dashboard', compact('jumlah_barang', 'jumlah_transaksi', 'total_penjualan', 'stok_menipis'));
    }
}