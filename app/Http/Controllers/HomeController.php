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
        $pendapatanKotorHariIni = Transaksi::whereDate('created_at', now()->toDateString())
            ->with('TransaksiDetail')
            ->get()
            ->sum(function ($transaksi) {
                return $transaksi->total_harga + ($transaksi->TransaksiDetail->first()->pengantaranStatus->name == "Tidak" ? 0 : 2000);
            });

        $pengeluaranHariIniQuery = Pengeluaran::whereDate('created_at', now()->toDateString())->get();
        $pengeluaranKotorHariIni = $pengeluaranHariIniQuery->every(fn($item) => $item->harga == 0)
            ? $pengeluaranHariIniQuery->sum('jumlah')
            : $pengeluaranHariIniQuery->sum(fn($item) => $item->harga * $item->jumlah);

        $keuntunganHariIni = $pendapatanKotorHariIni - $pengeluaranKotorHariIni;

        $pendapatanKotorBulanIni = Transaksi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->with('TransaksiDetail')
            ->get()
            ->sum(function ($transaksi) {
                return $transaksi->total_harga + ($transaksi->TransaksiDetail->first()->pengantaranStatus->name == "Tidak" ? 0 : 2000);
            });

        $pengeluaranBulanIniQuery = Pengeluaran::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();
        $pengeluaranKotorBulanIni = $pengeluaranBulanIniQuery->every(fn($item) => $item->harga == 0)
            ? $pengeluaranBulanIniQuery->sum('jumlah')
            : $pengeluaranBulanIniQuery->sum(fn($item) => $item->harga * $item->jumlah);

        $keuntunganBulanIni = $pendapatanKotorBulanIni - $pengeluaranKotorBulanIni;

        $pendapatanKotorTahunIni = Transaksi::whereYear('created_at', now()->year)
            ->with('TransaksiDetail')
            ->get()
            ->sum(function ($transaksi) {
                return $transaksi->total_harga + ($transaksi->TransaksiDetail->first()->pengantaranStatus->name == "Tidak" ? 0 : 2000);
            });

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

    public function month()
    {
        return [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
    }

    public function getChartData()
    {
        $monthlyData = Transaksi::selectRaw('MONTH(created_at) as month, SUM(total_harga) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = $this->month();
        $data = [];
        for ($i = 1; $i <= now()->month; $i++) {
            $data[] = [
                'month' => $months[$i],
                'total' => $monthlyData[$i] ?? 0
            ];
        }

        return response()->json($data);
    }

    public function getGalonAntarData()
    {
        $totalYa = Transaksi::whereHas('TransaksiDetail', function ($query) {
            $query->whereHas('pengantaranStatus', function ($query) {
                $query->where('name', 'Ya');
            });
        })->count();

        $totalTidak = Transaksi::whereHas('TransaksiDetail', function ($query) {
            $query->whereHas('pengantaranStatus', function ($query) {
                $query->where('name', 'Tidak');
            });
        })->count();

        return response()->json([
            'ya' => $totalYa,
            'tidak' => $totalTidak,
        ]);
    }
}
