@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="card mx-auto" style="max-width: 640px;">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Barang: {{ $barang->kode_barang }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label small text-muted">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label small text-muted">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label small text-muted">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $barang->harga) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label small text-muted">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" min="0" required>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-save"></i> Update Data</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection