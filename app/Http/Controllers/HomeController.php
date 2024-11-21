<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pendapatanKotorHariIni = Transaksi::whereDate('created_at', now()->toDateString())->sum('total_harga');

        $pengeluaranHariIniQuery = Pengeluaran::whereDate('created_at', now()->toDateString())->get();
        $pengeluaranKotorHariIni = $pengeluaranHariIniQuery->every(fn($item) => $item->harga == 0)
            ? $pengeluaranHariIniQuery->sum('jumlah')
            : $pengeluaranHariIniQuery->sum(fn($item) => $item->harga * $item->jumlah);

        $keuntunganHariIni = $pendapatanKotorHariIni - $pengeluaranKotorHariIni;

        $pendapatanKotorBulanIni = Transaksi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');

        $pengeluaranBulanIniQuery = Pengeluaran::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();
        $pengeluaranKotorBulanIni = $pengeluaranBulanIniQuery->every(fn($item) => $item->harga == 0)
            ? $pengeluaranBulanIniQuery->sum('jumlah')
            : $pengeluaranBulanIniQuery->sum(fn($item) => $item->harga * $item->jumlah);

        $keuntunganBulanIni = $pendapatanKotorBulanIni - $pengeluaranKotorBulanIni;


        $pendapatanKotorTahunIni = Transaksi::whereYear('created_at', now()->year)->sum('total_harga');

        $pengeluaranTahunIniQuery = Pengeluaran::whereYear('created_at', now()->year)->get();
        $pengeluaranKotorTahunIni = $pengeluaranTahunIniQuery->every(fn($item) => $item->harga == 0)
            ? $pengeluaranTahunIniQuery->sum('jumlah')
            : $pengeluaranTahunIniQuery->sum(fn($item) => $item->harga * $item->jumlah);

        $keuntunganTahunIni = $pendapatanKotorTahunIni - $pengeluaranKotorTahunIni;


        $totalDataPengeluaran = Pengeluaran::count();
        $totalDataPendapatan = Transaksi::count();
        $totalDataKeseluruhan = $totalDataPengeluaran + $totalDataPendapatan;

        return view('home', compact(
            'keuntunganHariIni',
            'keuntunganBulanIni',
            'keuntunganTahunIni',
            'totalDataKeseluruhan'
        ));
    }
}
