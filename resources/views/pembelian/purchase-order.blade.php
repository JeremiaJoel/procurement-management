<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Invoice Template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table th,
        .invoice-box table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .total {
            margin-top: 20px;
            width: 300px;
            float: right;
        }

        .total td {
            font-weight: bold;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="header">
            @php
                $path = public_path('img/logo.png');
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            @endphp
            <img src="{{ $base64 }}" alt="Company logo" style="width: 150px;" />
            <div>
                <p><span class="bold">Kode:</span> {{ $pengadaan->kode_pengadaan }}</p>
                <p><span class="bold">Tanggal:</span>
                    {{ \Carbon\Carbon::parse($pengadaan->tanggal)->translatedFormat('j F Y') }}</p>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <p><span class="bold">From:</span><br><span class="bold">Vitech Asia</span><br>12345 Sunny
                Road<br>Sunnyville, TX 12345</p>
            <p><span class="bold">To:</span><br><span
                    class="bold">{{ $pengadaan->nama_supplier }}</span><br>{!! preg_replace('/((\S+\s+){3})/', '$1<br>', $pengadaan->supplier->address) !!}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 60%;">Nama Barang</th>
                    <th style="width: 20%;">Qty</th>
                    <th style="width: 20%;">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $barang->barang->nama }}</td>
                        <td>{{ $barang->kuantitas }}</td>
                        <td>{{ $barang->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="total">
            <tr>
                <td>Pajak</td>
                <td>{{ $pengadaan->pajak }}</td>
            </tr>
            <tr>
                <td>Total Harga</td>
                <td>{{ $pengadaan->total_harga }}</td>
            </tr>
        </table>
        @if (strpos(url()->current(), 'download') == false)
            <a href="{{ route('purchase-order.download', $pengadaan->kode_pengadaan) }}">Download PDF</a>
        @endif

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda.</p>
        </div>
    </div>
</body>

</html>
