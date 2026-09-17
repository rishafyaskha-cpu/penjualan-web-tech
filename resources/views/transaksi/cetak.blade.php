<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi - {{ $transaksi->nomor_transaksi }}</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; width: 80mm; margin: 0 auto; }
        h2, p { text-align: center; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border-bottom: 1px dashed #000; padding: 5px; text-align: left; font-size: 12px; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body onload="window.print()">
<h2>TOKO RPL JAYA</h2>
<p>Nota: {{ $transaksi->nomor_transaksi }}</p>
<p>Tanggal: {{ $transaksi->tanggal }}</p>
<hr>
<table>
    @foreach($transaksi->detail_transaksis as $detail)
    <tr>
        <td colspan="2">{{ $detail->barang->nama_barang }}</td>
    </tr>
    <tr>
        <td>{{ $detail->jumlah }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
        <td class="total">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
    </tr>
    @endforeach
</table>
<hr>
<p class="total">TOTAL: Rp {{ number_format($transaksi->total, 0, ',', '.') }}</p>
<p style="margin-top: 20px;">Terima Kasih</p>
</body>
</html>