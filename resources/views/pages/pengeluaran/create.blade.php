@extends('layouts.app')
@section('title', 'Tambah Laporan Pengeluaran')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Form Input Tambah Pengeluaran
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('pengeluaran.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="basicInput">Nama Pengeluaran</label>
                                <input type="text" class="form-control" name="name" id="basicInput"
                                    placeholder="Masukkan Nama Pengeluaran">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="basicInput">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="basicInput"
                                    placeholder="Masukkan Jumlah">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="basicInput">Harga</label>
                                <input type="number" name="harga" class="form-control" id="basicInput"
                                    placeholder="Masukkan Harga Pengeluaran">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Keterangan</label>
                            <textarea name="keterangan" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary float-end">Simpan <i class="bi bi-check"></i></button>
                </form>
            </div>
        </div>
    </section>
@endsection
