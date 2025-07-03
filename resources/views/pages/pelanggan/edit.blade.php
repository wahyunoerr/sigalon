@extends('layouts.app')
@section('title', 'Edit Pelanggan')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Pelanggan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.update', ['pelanggan' => $pelanggan]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $pelanggan->name }}" placeholder="Masukkan Nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="{{ $pelanggan->alamat }}" placeholder="Masukkan Alamat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="noHp">No HP</label>
                                <input type="text" class="form-control" id="noHp" name="noHp"
                                    value="{{ $pelanggan->noHp }}" placeholder="Masukkan No HP" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>
                        Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
