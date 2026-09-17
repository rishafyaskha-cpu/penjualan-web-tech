@extends('layouts.app')

@section('title', 'Detail ' . $transaksi->nomor_transaksi)

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 fw-bold"><i class="bi bi-file-text me-2 text-primary"></i>Detail Transaksi: {{ $transaksi->nomor_transaksi }}</h4>
        <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank" class="btn btn-secondary"><i class="bi bi-printer"></i> Cetak Nota</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <p class="mb-1"><strong>No. Transaksi:</strong> <span class="badge bg-primary">{{ $transaksi->nomor_transaksi }}</span></p>
        <p class="mb-4"><strong>Tanggal:</strong> <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</p>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detail_transaksis as $i => $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $detail->barang->nama_barang }}</td>
                        <td class="text-center">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $detail->jumlah }}</td>
                        <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-light fw-bold">
                        <th colspan="4" class="text-end">TOTAL</th>
                        <th class="text-end fs-5 text-primary">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="bi bi-cart-plus"></i> Transaksi Baru</a>
        </div>
    </div>
</div>
@endsection