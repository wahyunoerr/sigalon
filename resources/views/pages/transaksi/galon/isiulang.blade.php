@extends('layouts.app')
@section('title', 'Isi Ulang Galon')
@section('content')
    <section class="section">
        <form action="{{ route('isiUlang.save') }}" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form @yield('title')</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Jenis Galon</label>
                                <div class="form-group">
                                    <select class="choices form-select form-control multiple-remove" name="galon_id[]"
                                        multiple="multiple" value="{{ old('galon_id[]') }}">
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
                        @foreach ($data as $item)
                            <div class="col-md-6 galon-quantity d-none" id="galon-quantity-{{ $item->id }}">
                                <div class="form-group">
                                    <label for="jumlah-{{ $item->id }}">Jumlah Galon {{ $item->name }}</label>
                                    <input type="number" class="form-control" id="jumlah-{{ $item->id }}"
                                        name="jumlah[{{ $item->id }}]"
                                        placeholder="Masukkan Jumlah Galon {{ $item->name }}">
                                </div>
                            </div>
                        @endforeach
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
                        <div class="col-md-6 d-none" id="alamatPengantaran">
                            <div class="form-group">
                                <label for="alamat">Alamat Pengantaran</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Masukkan Alamat Pengantaran" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 d-none" id="noHp">
                            <div class="form-group">
                                <label for="noHp">Nomor Telepon Pelanggan</label>
                                <input type="number" class="form-control" id="noHp" name="noHp"
                                    placeholder="Masukkan nomor telepon" value="{{ old('noHp') }}">
                                @error('noHp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('isiUlang') }}" class="btn btn-sm btn-secondary icon"><i
                                class="bi bi-arrow-left"></i>
                            Kembali</a>
                        <button type="submit" class="btn icon btn-success"><i class="bi bi-check-lg"></i>
                            Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusAntarSelect = document.getElementById("statusAntarSelect");
            const alamatPengantaran = document.getElementById("alamatPengantaran");
            const noHp = document.getElementById("noHp");
            const galonSelect = document.querySelector('select[name="galon_id[]"]');

            statusAntarSelect.addEventListener("change", function() {
                const yaValue = "{{ $statusA->firstWhere('name', 'Ya')->id ?? '' }}";

                if (statusAntarSelect.value === yaValue) {
                    alamatPengantaran.classList.remove("d-none");
                    noHp.classList.remove("d-none");
                } else {
                    alamatPengantaran.classList.add("d-none");
                    noHp.classList.add("d-none");
                }
            });

            galonSelect.addEventListener("change", function() {
                document.querySelectorAll('.galon-quantity').forEach(function(element) {
                    element.classList.add('d-none');
                });

                Array.from(galonSelect.selectedOptions).forEach(function(option) {
                    document.getElementById('galon-quantity-' + option.value).classList.remove(
                        'd-none');
                });
            });
        });
    </script>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ada beberapa kesalahan pada form Anda.',
                footer: '<ul>' +
                    @foreach ($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
            });
        </script>
    @endif
@endsection
