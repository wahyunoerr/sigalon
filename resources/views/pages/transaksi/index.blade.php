@extends('layouts.app')
@section('title', 'Transaksi Isi Galon')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Datatable @yield('title')
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Kode Transaksi</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->kode_transaksi }}</td>
                                <td>{{ $t->jumlah }}</td>
                                <td>Rp. {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="buttons">
                                        <a href="#" class="btn btn-sm icon btn-info"><i
                                                class="bi bi-info-circle"></i></a>
                                        <a href="#" class="btn btn-sm icon btn-danger" data-confirm-delete="true"><i
                                                class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
