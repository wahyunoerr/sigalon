@extends('layouts.app')
@section('title', 'Status Antar')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Datatable @yield('title')
                    </h5>
                    <a href="{{ route('antar.create') }}" class="btn icon btn-success">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Nama Status</th>
                            <th>Harga</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ number_format($d->harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="buttons">
                                        <a href="{{ route('antar.edit', ['statusAntar' => $d]) }}"
                                            class="btn btn-sm icon btn-primary"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ route('antar.delete', ['statusAntar' => $d]) }}"
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
