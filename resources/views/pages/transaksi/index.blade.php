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
                @hasrole('admin')
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <form action="{{ route('transaksi.filter') }}" method="GET" class="form-inline">
                                <div class="form-group mr-2">
                                    <label for="start_date" class="mr-2">Dari Tanggal:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="form-group mr-2">
                                    <label for="end_date" class="mr-2">Sampai Tanggal:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                                <a href="{{ route('transaksi') }}" class="btn btn-secondary">Reset</a>
                            </form>
                        </div>
                    </div>
                @endhasrole
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Tanggal Transaksi</th>
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
                                <td>{{ $t->created_at->format('d/m/Y') }}</td>
                                <td>{{ $t->kode_transaksi }}</td>
                                <td>{{ $t->jumlah }}</td>
                                <td>Rp.
                                    {{ number_format($t->total_harga + ($t->TransaksiDetail->first()->pengantaranStatus->name == 'Tidak' ? 0 : $t->TransaksiDetail->first()->pengantaranStatus->harga), 0, ',', '.') }}
                                </td>
                                <td>
                                    <div class="buttons">
                                        <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-sm icon btn-info"><i
                                                class="bi bi-info-circle"></i></a>
                                        @hasrole('admin')
                                            <a href="{{ route('transaksi.destroy', $t->id) }}"
                                                class="btn btn-sm icon btn-danger" data-confirm-delete="true"><i
                                                    class="bi bi-trash"></i></a>
                                        @endhasrole
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
