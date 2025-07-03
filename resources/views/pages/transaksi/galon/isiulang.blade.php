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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pelangganSelect">Pilih Pelanggan</label>
                                <select name="pelanggan_id" id="pelangganSelect" class="form-control">
                                    <option selected disabled>--Pilih--</option>
                                    <option value="new">Tambah Pelanggan Baru</option>
                                    @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }} - {{ $p->noHp }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 d-none" id="nameInput">
                            <div class="form-group">
                                <label for="name">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan Nama Pelanggan" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 d-none" id="alamatInput">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Masukkan Alamat" value="{{ old('alamat') }}">
                            </div>
                        </div>
                        <div class="col-md-6 d-none" id="noHpInput">
                            <div class="form-group">
                                <label for="noHp">Nomor Telepon</label>
                                <input type="number" class="form-control" id="noHp" name="noHp"
                                    placeholder="Masukkan Nomor Telepon" value="{{ old('noHp') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Jenis Galon</label>
                                <select class="choices form-select form-control multiple-remove" name="galon_id[]"
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
                                        <option value="{{ $sa->id }}">{{ $sa->name }}</option>
                                    @endforeach
                                </select>
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
            const pelangganSelect = document.getElementById("pelangganSelect");
            const nameInput = document.getElementById("name");
            const alamatInput = document.getElementById("alamat");
            const noHpInput = document.getElementById("noHp");

            pelangganSelect.addEventListener("change", function() {
                if (pelangganSelect.value === "new") {
                    nameInput.value = "";
                    alamatInput.value = "";
                    noHpInput.value = "";
                    nameInput.disabled = false;
                    alamatInput.disabled = false;
                    noHpInput.disabled = false;
                    document.getElementById("nameInput").classList.remove("d-none");
                    document.getElementById("alamatInput").classList.remove("d-none");
                    document.getElementById("noHpInput").classList.remove("d-none");
                } else if (pelangganSelect.value) {
                    const pelangganData = @json($pelanggan->keyBy('id'));
                    const selectedPelanggan = pelangganData[pelangganSelect.value];

                    nameInput.value = selectedPelanggan.name;
                    alamatInput.value = selectedPelanggan.alamat;
                    noHpInput.value = selectedPelanggan.noHp;
                    nameInput.disabled = true;
                    alamatInput.disabled = true;
                    noHpInput.disabled = true;
                    document.getElementById("nameInput").classList.remove("d-none");
                    document.getElementById("alamatInput").classList.remove("d-none");
                    document.getElementById("noHpInput").classList.remove("d-none");
                } else {
                    document.getElementById("nameInput").classList.add("d-none");
                    document.getElementById("alamatInput").classList.add("d-none");
                    document.getElementById("noHpInput").classList.add("d-none");
                }
            });

            const galonSelect = document.querySelector('select[name="galon_id[]"]');
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
@endsection
