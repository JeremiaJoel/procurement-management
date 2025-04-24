<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Daily Report Preview</title>

    <style>
        .invoice-box {
            max-width: 700px;
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
            border-collapse: collapse;
            /* Ensures borders are not doubled */
            margin-top: 20px;
            border: none;
        }

        .invoice-box table th,
        .invoice-box table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;

        }

        /* Table Header Styling */
        .invoice-box table thead th {
            background-color: #007bff;
            /* Blue background for header */
            color: white;
            /* White text */
            font-weight: bold;


        }

        /* Alternating Row Colors */
        .invoice-box table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Light gray for even rows */
        }



        /* Remove borders for the "From" and "To" table */
        /* .from-to-table {
            border-collapse: collapse;

            /* Remove table border */
        /* width: 100%;
            margin-top: 20px;
        } */

        .from-to-table td {

            /* Remove cell borders */
            padding: 10px;
            vertical-align: top;
        }

        .from-to-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .bold {
            font-weight: bold;
        }

        .purchase-order-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .purchase-order-header h1 {
            font-size: 1.875rem;
            font-weight: bold;
            text-align: center;
            color: black;
        }

        .download-wrapper {
            text-align: center;
            margin-top: 1rem;
        }

        .download-pdf {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="purchase-order-header">
            <h1>Laporan Harian</h1>
        </div>
        @php
            $path = public_path('img/logo.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td style="width: 50%; border:none;">
                    <img src="{{ $base64 }}" alt="Company logo" style="max-width: 120px;" />
                </td>
                <td style="width: 50%; text-align: right; vertical-align: top; border:none;">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="font-weight: bold; padding: 4px; border:none;">Laporan Tanggal:</td>
                            <td style="padding: 4px; border:none;">
                                {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('j F Y') }}
                            </td>

                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 4px; border:none;">Total Pengadaan:</td>
                            <td style="padding: 4px; border:none;">
                                {{ $jumlahPengadaan }}
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- Main Table -->
        <table>
            <thead>
                <tr>
                    <th style="width: 25%;">Kode Pengadaan</th>
                    <th style="width: 40%;">Nama Pengadaan</th>
                    <th style="width: 20%;">Total Harga</th>
                    <th style="width: 20%;">Status</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($pengadaans as $index => $pengadaan)
                    <tr>
                        <td>{{ $pengadaan + $index }}</td>
                        <td>{{ $pengadaan->nama_pengadaan }}</td>
                        <td>{{ $pengadaan->total_harga }}</td>
                        <td>{{ $pengadaan->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="text-align: right; padding: 10px; border:none" colspan="3">
                        <div
                            style="display: inline-block; padding: 8px 16px; background-color: #f3f4f6; border: 1px solid #d1d5db; border-radius: 4px; font-weight: bold;">
                            Total Pengeluaran: Rp {{ number_format($totalHarga, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>




        @if (strpos(url()->current(), 'download') === false)
            <div class="download-wrapper">
                <a class="download-pdf" href="{{ route('invoice.download', $pengadaan->kode_pengadaan) }}">
                    Download PDF
                </a>
            </div>
        @endif
    </div>
</body>

</html>
