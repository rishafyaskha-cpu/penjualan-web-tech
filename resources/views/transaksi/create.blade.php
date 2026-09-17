@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h4 class="mb-0 fw-bold"><i class="bi bi-cart-plus me-2 text-primary"></i>Form Transaksi Penjualan</h4>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger py-2">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <table class="table table-bordered align-middle" id="tabel-transaksi">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center" style="width:45%">Pilih Barang</th>
                        <th class="text-center" style="width:30%">Jumlah</th>
                        <th class="text-center" style="width:10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="barang_id[]" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $brg)
                                    <option value="{{ $brg->id }}">{{ $brg->kode_barang }} - {{ $brg->nama_barang }} (Stok: {{ $brg->stok }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="jumlah[]" class="form-control" min="1" placeholder="0" required>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm btn-tambah"><i class="bi bi-plus-lg"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-semibold"><i class="bi bi-check2-circle"></i> Proses Transaksi</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Ke Riwayat</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('.btn-tambah').addEventListener('click', function() {
        let barisBaru = document.querySelector('#tabel-transaksi tbody tr').cloneNode(true);
        let btn = barisBaru.querySelector('.btn-tambah');
        btn.classList.replace('btn-success', 'btn-danger');
        btn.classList.replace('btn-tambah', 'btn-hapus');
        btn.innerHTML = '<i class="bi bi-dash-lg"></i>';
        barisBaru.querySelector('input').value = '';
        barisBaru.querySelector('.btn-hapus').addEventListener('click', function() {
            this.closest('tr').remove();
        });
        document.querySelector('#tabel-transaksi tbody').appendChild(barisBaru);
    });
</script>
@endsection