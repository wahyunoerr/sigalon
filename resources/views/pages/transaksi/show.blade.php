@extends('layouts.app')
@section('title', 'Detail Transaksi')
@section('content')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .printableArea,
            .printableArea * {
                visibility: visible;
            }

            .printableArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .card-header,
            .btn {
                display: none;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }

            .table th,
            .table tr,
            .table td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
                color: black;
            }

            .table th {
                color: black;
            }

            .table tr {
                color: black;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            .card-header {
                background-color: #007bff;
                color: black;
            }

            .card-title {
                color: black;
            }
        }

        .card {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-bottom: 1px solid #e9ecef;
            border-radius: 10px 10px 0 0;
        }

        .card-title {
            margin: 0;
        }

        .btn {
            margin-left: auto;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .thead-dark th {
            background-color: #e0f7fa;
            color: black;
        }
    </style>
    <div class="col-12">
        <div class="card printableArea">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Detail Transaksi {{ $transaksi->created_at->format('d/m/Y') }}</h4>
                <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-lg table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Data Transaksi</th>
                                    <th>Galon</th>
                                    <th>Jumlah</th>
                                    <th>Harga Galon</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi->TransaksiDetail as $detail)
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ $transaksi->TransaksiDetail->count() }}">
                                                <strong>Kode Transaksi:</strong> {{ $transaksi->kode_transaksi }}<br>
                                                <strong>Nama:</strong> {{ $detail->pelanggan->name }}<br>
                                                <strong>Alamat:</strong> {{ $detail->pelanggan->alamat }}<br>
                                                <strong>No HP:</strong> {{ $detail->pelanggan->noHp }}
                                            </td>
                                        @endif
                                        <td>{{ $detail->galon->name }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>Rp. {{ number_format($detail->galon->harga, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($detail->subTotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Antar Galon:</th>
                                    <th>
                                        @if ($transaksi->TransaksiDetail->first()->pengantaranStatus->name == 'Tidak')
                                            Rp. 0
                                        @else
                                            Rp.
                                            {{ number_format($transaksi->TransaksiDetail->first()->pengantaranStatus->harga, 0, ',', '.') }}
                                        @endif

                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align:right">Fee Karyawan:</th>
                                    <th>
                                        @if ($transaksi->TransaksiDetail->first()->pengantaranStatus->name == 'Tidak')
                                            Rp. 0
                                        @else
                                            Rp. -500
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th>
                                        Rp.
                                        {{ number_format(
                                            $transaksi->TransaksiDetail->sum('subTotal') +
                                                ($transaksi->TransaksiDetail->first()->pengantaranStatus->name == 'Tidak'
                                                    ? 0
                                                    : $transaksi->TransaksiDetail->first()->pengantaranStatus->harga) +
                                                ($transaksi->TransaksiDetail->first()->pengantaranStatus->name == 'Tidak' ? 0 : -500),
                                            0,
                                            ',',
                                            '.',
                                        ) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
