@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 fw-bold">Dashboard Toko RPL Jaya</h2>
    <a href="{{ route('transaksi.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Transaksi Baru</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-uppercase small fw-semibold opacity-75">Total Barang</div>
                    <h3 class="fw-bold mb-0">{{ $jumlah_barang }} <span class="fs-6 fw-normal">Item</span></h3>
                </div>
                <i class="bi bi-box-seam display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-uppercase small fw-semibold opacity-75">Total Transaksi</div>
                    <h3 class="fw-bold mb-0">{{ $jumlah_transaksi }} <span class="fs-6 fw-normal">Transaksi</span></h3>
                </div>
                <i class="bi bi-receipt display-4 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-dark bg-warning border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-uppercase small fw-semibold opacity-75">Total Pendapatan</div>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($total_penjualan, 0, ',', '.') }}</h3>
                </div>
                <i class="bi bi-cash-coin display-4 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card border-danger border-2">
    <div class="card-header bg-danger text-white d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <h4 class="mb-0 fw-semibold">Peringatan: Stok Menipis</h4>
    </div>
    <div class="card-body">
        @if($stok_menipis->isEmpty())
            <p class="text-success mb-0"><i class="bi bi-check-circle-fill"></i> Semua stok barang aman.</p>
        @else
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th>Kode</th><th>Nama Barang</th><th>Sisa Stok</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @foreach($stok_menipis as $brg)
                    <tr>
                        <td><span class="badge bg-light text-dark border">{{ $brg->kode_barang }}</span></td>
                        <td class="fw-semibold">{{ $brg->nama_barang }}</td>
                        <td class="text-danger fw-bold">{{ $brg->stok }}</td>
                        <td>
                            @if($brg->stok <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @else
                                <span class="badge bg-warning text-dark">Menipis</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection