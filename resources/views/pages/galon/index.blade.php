@extends('layouts.app')
@section('title', 'Galon')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Datatable @yield('title')
                    </h5>
                    <a href="{{ route('galon.create') }}" class="btn icon btn-success">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Jenis Galon</th>
                            <th>Harga</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galon as $g)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $g->name }}</td>
                                <td>Rp. {{ number_format($g->harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="buttons">
                                        <a href="{{ route('galon.edit', ['galon' => $g]) }}"
                                            class="btn btn-sm icon btn-primary"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ route('galon.delete', ['galon' => $g]) }}"
                                            class="btn btn-sm icon btn-danger" data-confirm-delete="true"><i
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
