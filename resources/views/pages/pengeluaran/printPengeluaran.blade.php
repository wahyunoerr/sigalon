<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pengeluaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .header,
        .footer {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .header h1,
        .footer p {
            margin: 0;
        }

        .content {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .content p {
            text-align: center;
            font-size: 1.2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Invoice Pengeluaran</h1>
    </div>
    <div class="container">
        <div class="content">
            <h2>Detail Pengeluaran</h2>
            @if (request('start_date') && request('end_date'))
                <p>Menampilkan data dari tanggal {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }}
                    sampai
                    {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}</p>
            @endif
            <table>
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengeluaran as $pe)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($pe->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $pe->name }}</td>
                            <td>{{ $pe->jumlah }}</td>
                            <td>Rp. {{ number_format($pe->harga, 0, ',', '.') }}</td>
                            <td>{{ $pe->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer no-print">
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
