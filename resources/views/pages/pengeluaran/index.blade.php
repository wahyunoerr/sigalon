@extends('layouts.app')
@section('title', 'Pengeluaran')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pengeluaran Hari ini</h6>
                                <h6 class="font-extrabold mb-0">Rp. {{ number_format($pengeluaranHariIni, 0, ',', '.') }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pengeluaran Bulan ini</h6>
                                <h6 class="font-extrabold mb-0">Rp. {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pengeluaran Tahun Ini</h6>
                                <h6 class="font-extrabold mb-0">Rp. {{ number_format($pengeluaranTahunIni, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Data Pengeluaran</h6>
                                <h6 class="font-extrabold mb-0">{{ $totalDataPengeluaran }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Datatable @yield('title')
                    </h5>
                    <a href="{{ route('pengeluaran.create') }}" class="btn icon btn-success">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengeluaran as $pe)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date_format($pe->created_at, 'd/m/Y') }}</td>
                                <td>{{ $pe->name }}</td>
                                <td>{{ $pe->jumlah }}</td>
                                <td>Rp. {{ number_format($pe->harga, 0, ',', '.') }}</td>
                                <td>{{ $pe->keterangan }}</td>
                                <td>
                                    <div class="buttons">
                                        <a href="{{ route('pengeluaran.edit', ['pengeluaran' => $pe]) }}"
                                            class="btn btn-sm icon btn-primary"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ route('pengeluaran.destroy', ['pengeluaran' => $pe]) }}"
                                            class="btn btn-sm icon btn-danger" data-confirm-delete="true"><i
                                                class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="10%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th width="20%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
@endsection
