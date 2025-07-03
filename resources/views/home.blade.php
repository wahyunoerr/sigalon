@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <h4 class="font-bold">Selamat Datang, {{ auth()->user()->name }}!</h4>
                        </div>
                    </div>
                </div>
                @role('admin')
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pendapatan Bersih Hari ini : </h6>
                                        <h6 class="font-extrabold mb-0">Rp. {{ number_format($keuntunganHariIni, 0, ',', '.') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pendapatan Bersih Bulan Ini : </h6>
                                        <h6 class="font-extrabold mb-0">Rp.
                                            {{ number_format($keuntunganBulanIni, 0, ',', '.') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pendapatan Bersih Tahun Ini : </h6>
                                        <h6 class="font-extrabold mb-0">Rp.
                                            {{ number_format($keuntunganBulanIni, 0, ',', '.') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Data Transaksi Keseluruhan : </h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalDataKeseluruhan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaksi</h4>
                            </div>
                            <div class="card-body">
                                <div id="area"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="./assets/compiled/jpg/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                            <h6 class="text-muted mb-0">@admin</h6>
                        </div>
                    </div>
                </div>
            </div>
            @role('admin')
                <div class="card">
                    <div class="card-header">
                        <h4>Galon Diantar</h4>
                    </div>
                    <div class="card-content pb-4">
                        <div id="pengantaran-galon"></div>
                    </div>
                </div>
            @endrole
        </div>
    </section>
@endsection

@push('scripts')
