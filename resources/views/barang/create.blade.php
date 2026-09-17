@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="card mx-auto" style="max-width: 640px;">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 fw-bold"><i class="bi bi-plus-square me-2 text-primary"></i>Tambah Barang Baru</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small text-muted">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" placeholder="cth: BRG006" required>
            </div>
            <div class="mb-3">
                <label class="form-label small text-muted">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="cth: Webcam" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small text-muted">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" placeholder="cth: 150000" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small text-muted">Stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="cth: 10" min="0" required>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection