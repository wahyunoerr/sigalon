@extends('layouts.app')
@section('title', 'Isi Ulang Galon')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form @yield('title')</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('isiUlang') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Jenis Galon</label>
                                <div class="form-group">
                                    <select class="choices form-select form-control multiple-remove" name="galon_id"
                                        multiple="multiple">
                                        <optgroup label="Pilih">
                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} | Rp.
                                                    {{ number_format($item->harga, 0, ',', '.') }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Jumlah Galon</label>
                                <input type="number" class="form-control" id="basicInput" name="jumlah"
                                    placeholder="Masukkan Jumlah Galon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Apakah diantar?</label>
                                <select name="statusAntar_id" id="statusAntarSelect" class="form-control">
                                    <option selected disabled>--Pilih--</option>
                                    @foreach ($statusA as $sa)
                                        <option value="{{ $sa->id }}">{{ $sa->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="alamatPengantaran" style="display: none;">
                            <div class="form-group">
                                <label for="alamat">Alamat Pengantaran</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Masukkan Alamat Pengantaran">
                            </div>
                        </div>
                        <div class="col-md-6" id="noHp" style="display: none;">
                            <div class="form-group">
                                <label for="noHp">Nomor Telepon Pelanggan</labrel>
                                    <input type="text" class="form-control" id="noHp" name="noHp"
                                        placeholder="Masukkan nomor telepon">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('isiUlang') }}" class="btn btn-sm btn-secondary icon"><i class="bi bi-arrow-left"></i>
                        Kembali</a>
                    <button type="submit" class="btn icon btn-success"><i class="bi bi-check-lg"></i>
                        Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusAntarSelect = document.getElementById("statusAntarSelect");
            const alamatPengantaran = document.getElementById("alamatPengantaran");
            const noHp = document.getElementById("noHp");
            statusAntarSelect.addEventListener("change", function() {
                const yaValue = "{{ $statusA->firstWhere('name', 'Ya')->id ?? '' }}";

                if (statusAntarSelect.value === yaValue) {
                    alamatPengantaran.style.display = "block";
                    noHp.style.display = "block";
                } else {
                    alamatPengantaran.style.display = "none";
                    noHp.style.display = "none";
                }
            });
        });
    </script>
@endsection
