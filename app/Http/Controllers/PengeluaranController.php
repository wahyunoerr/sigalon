<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        $pengeluaran = Pengeluaran::all();

        $pengeluaranHariIniQuery = Pengeluaran::whereDate('created_at', now()->toDateString())->get();

        if ($pengeluaranHariIniQuery->isEmpty() || $pengeluaranHariIniQuery->every(fn($item) => $item->harga == 0)) {
            $pengeluaranHariIni = $pengeluaranHariIniQuery->sum('jumlah'); // Jumlahkan 'jumlah' jika semua data Fee Karyawan
        } else {
            $pengeluaranHariIni = $pengeluaranHariIniQuery->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });
        }


        $pengeluaranBulanIniQuery = Pengeluaran::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        if ($pengeluaranBulanIniQuery->isEmpty() || $pengeluaranBulanIniQuery->every(fn($item) => $item->harga == 0)) {
            $pengeluaranBulanIni = $pengeluaranBulanIniQuery->sum('jumlah');
        } else {
            $pengeluaranBulanIni = $pengeluaranBulanIniQuery->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });
        }

        $pengeluaranTahunIniQuery = Pengeluaran::whereYear('created_at', now()->year)->get();

        if ($pengeluaranTahunIniQuery->isEmpty() || $pengeluaranTahunIniQuery->every(fn($item) => $item->harga == 0)) {
            $pengeluaranTahunIni = $pengeluaranTahunIniQuery->sum('jumlah');
        } else {
            $pengeluaranTahunIni = $pengeluaranTahunIniQuery->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });
        }

        $totalDataPengeluaran = Pengeluaran::count();

        return view('pages.pengeluaran.index', compact(
            'pengeluaran',
            'pengeluaranHariIni',
            'pengeluaranBulanIni',
            'pengeluaranTahunIni',
            'totalDataPengeluaran'
        ));
    }

    /**
     * Filter the resource based on date range.
     */
    public function filter(Request $request)
    {
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        $query = Pengeluaran::query();

        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $pengeluaran = $query->get();

        $pengeluaranHariIniQuery = Pengeluaran::whereDate('created_at', now()->toDateString())->get();

        if ($pengeluaranHariIniQuery->isEmpty() || $pengeluaranHariIniQuery->every(fn($item) => $item->harga == 0)) {
            $pengeluaranHariIni = $pengeluaranHariIniQuery->sum('jumlah'); // Jumlahkan 'jumlah' jika semua data Fee Karyawan
        } else {
            $pengeluaranHariIni = $pengeluaranHariIniQuery->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });
        }


        $pengeluaranBulanIniQuery = Pengeluaran::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        if ($pengeluaranBulanIniQuery->isEmpty() || $pengeluaranBulanIniQuery->every(fn($item) => $item->harga == 0)) {
            $pengeluaranBulanIni = $pengeluaranBulanIniQuery->sum('jumlah');
        } else {
            $pengeluaranBulanIni = $pengeluaranBulanIniQuery->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });
        }

        $pengeluaranTahunIniQuery = Pengeluaran::whereYear('created_at', now()->year)->get();

        if ($pengeluaranTahunIniQuery->isEmpty() || $pengeluaranTahunIniQuery->every(fn($item) => $item->harga == 0)) {
            $pengeluaranTahunIni = $pengeluaranTahunIniQuery->sum('jumlah');
        } else {
            $pengeluaranTahunIni = $pengeluaranTahunIniQuery->sum(function ($item) {
                return $item->harga * $item->jumlah;
            });
        }

        $totalDataPengeluaran = Pengeluaran::count();

        return view('pages.pengeluaran.index', compact(
            'pengeluaran',
            'pengeluaranHariIni',
            'pengeluaranBulanIni',
            'pengeluaranTahunIni',
            'totalDataPengeluaran'
        ));
    }

    /**
     * Print the filtered or unfiltered data.
     */
    public function print(Request $request)
    {
        $query = Pengeluaran::query();

        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $pengeluaran = $query->get();

        return view('pages.pengeluaran.printPengeluaran', compact('pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:5',
                'jumlah' => 'required',
                'harga' => 'required',
                'keterangan' => 'required|min:5'
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.min' => 'Minimal 5 karakter',
                'jumlah.required' => 'Jumlah tidak boleh kosong',
                'harga.required' => 'Harga tidak boleh kosong',
                'keterangan.required' => 'Keterangan tidak boleh kosong',
                'keterangan.min' => 'Minimal 5 karakter',
            ]
        );

        Pengeluaran::create($request->all());

        return redirect('pengeluaran')->withSuccess('Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->back()->withSuccess('Data Berhasil Dihapus!');
    }
}
