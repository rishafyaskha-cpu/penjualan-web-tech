<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;
        $query = Transaksi::query();

        if ($tgl_mulai && $tgl_akhir) {
            $query->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir]);
        }

        $transaksis = $query->orderBy('tanggal', 'desc')->get();
        $total_laporan = $transaksis->sum('total');

        return view('transaksi.index', compact('transaksis', 'total_laporan'));
    }

    public function create()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        $lastTransaksi = Transaksi::latest()->first();
        $nextId = $lastTransaksi ? $lastTransaksi->id + 1 : 1;
        $nomor_transaksi = 'TRX-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        DB::beginTransaction();

        try {
            $total_semua = 0;

            $transaksi = Transaksi::create([
                'nomor_transaksi' => $nomor_transaksi,
                'tanggal' => now(),
                'total' => 0,
            ]);

            foreach ($request->barang_id as $key => $barang_id) {
                $jumlah_beli = $request->jumlah[$key];
                $barang = Barang::findOrFail($barang_id);

                if ($jumlah_beli > $barang->stok) {
                    throw new \Exception("Stok " . $barang->nama_barang . " tidak cukup!");
                }

                $subtotal = $barang->harga * $jumlah_beli;
                $total_semua += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'harga' => $barang->harga,
                    'jumlah' => $jumlah_beli,
                    'subtotal' => $subtotal,
                ]);

                $barang->stok -= $jumlah_beli;
                $barang->save();
            }

            $transaksi->update(['total' => $total_semua]);

            DB::commit();

            return redirect()->route('transaksi.show', $transaksi->id)->with('success', 'Transaksi berhasil diproses!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('detail_transaksis.barang')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function cetak($id)
    {
        $transaksi = Transaksi::with('detail_transaksis.barang')->findOrFail($id);
        return view('transaksi.cetak', compact('transaksi'));
    }
}