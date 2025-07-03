@extends('layouts.app')
@section('title', 'Pelanggan')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Data Pelanggan
                    </h5>
                    <a href="{{ route('pelanggan.create') }}" class="btn icon btn-success">Tambah Pelanggan</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggans as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->noHp }}</td>
                                <td>
                                    <div class="d-flex">
                                        @role('admin')
                                            <a href="{{ route('pelanggan.edit', ['pelanggan' => $p]) }}"
                                                class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil"></i> Edit</a>
                                            <form action="{{ route('pelanggan.destroy', ['pelanggan' => $p]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('pelanggan.destroy', ['pelanggan' => $p]) }}"
                                                    class="btn btn-sm btn-danger" data-confirm-delete="true">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </form>
                                        @endrole
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
