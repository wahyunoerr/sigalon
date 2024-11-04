@extends('layouts.app')
@section('title', 'Edit Status Antar')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form @yield('title')</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('antar.update', ['statusAntar' => $statusAntar]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Nama Status</label>
                                <input type="text" value="{{ $statusAntar->name }}" class="form-control" id="basicInput"
                                    name="name" placeholder="Masukkan Nama Status">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Harga</label>
                                <input type="number" value="{{ $statusAntar->harga }}" class="form-control" id="basicInput"
                                    name="harga" placeholder="Masukkan Harga">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('antar') }}" class="btn btn-sm btn-secondary icon"><i class="bi bi-arrow-left"></i>
                        Kembali</a>
                    <button class="btn icon btn-success" type="submit"><i class="bi bi-check-lg"></i>
                        Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
