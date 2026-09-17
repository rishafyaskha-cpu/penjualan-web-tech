@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 fw-bold"><i class="bi bi-box-seam me-2 text-primary"></i>Daftar Barang</h4>
        <a href="{{ route('barang.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Barang</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('barang.index') }}" method="GET" class="mb-3 d-flex">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari nama / kode barang..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
                @if(request('search'))
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $item)
                    <tr>
                        <td><span class="badge bg-light text-dark border">{{ $item->kode_barang }}</span></td>
                        <td class="fw-semibold">{{ $item->nama_barang }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($item->stok <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($item->stok <= 5)
                                <span class="badge bg-warning text-dark">{{ $item->stok }}</span>
                            @else
                                <span class="badge bg-success">{{ $item->stok }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox display-6 d-block mb-2"></i>
                            @if(request('search'))
                                Barang tidak ditemukan untuk pencarian "{{ request('search') }}".
                            @else
                                Belum ada data barang.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection