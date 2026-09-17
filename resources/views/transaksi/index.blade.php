@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 fw-bold"><i class="bi bi-receipt me-2 text-primary"></i>Riwayat Transaksi</h4>
        <a href="{{ route('transaksi.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Buat Transaksi</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('transaksi.index') }}" method="GET" class="row g-2 mb-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Dari Tanggal</label>
                <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted mb-1">Sampai Tanggal</label>
                <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Filter</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
            </div>
        </form>

        @if(request('tgl_mulai') && request('tgl_akhir'))
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <div><strong>Laporan Penjualan:</strong> {{ request('tgl_mulai') }} s/d {{ request('tgl_akhir') }}</div>
                <div class="fw-bold">Total: Rp {{ number_format($total_laporan, 0, ',', '.') }}</div>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>No. Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $trx)
                    <tr>
                        <td><span class="badge bg-primary">{{ $trx->nomor_transaksi }}</span></td>
                        <td><i class="bi bi-calendar3 me-1 text-muted"></i>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                        <td class="fw-bold">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-info btn-sm text-white"><i class="bi bi-eye"></i> Detail</a>
                            <a href="{{ route('transaksi.cetak', $trx->id) }}" target="_blank" class="btn btn-secondary btn-sm"><i class="bi bi-printer"></i> Cetak</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox display-6 d-block mb-2"></i>Belum ada transaksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection