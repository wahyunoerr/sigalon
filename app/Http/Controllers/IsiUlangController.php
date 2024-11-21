<?php

namespace App\Http\Controllers;

use App\Models\Galon;
use App\Models\Pengeluaran;
use App\Models\statusAntar;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IsiUlangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Galon::all();
        $statusA = statusAntar::all();

        return view('pages.transaksi.galon.isiulang', compact('data', 'statusA'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $yaValue = StatusAntar::where('name', 'Ya')->first()->id ?? null;

        $validatorYa = Validator::make($request->all(), [
            'alamat' => 'nullable|string|required_if:statusAntar_id,' . $yaValue,
            'noHp' => 'nullable|numeric|required_if:statusAntar_id,' . $yaValue,
        ], [
            'alamat.required_if' => 'Alamat tidak boleh kosong!',
            'noHp.required_if' => 'Nomor Telepon tidak boleh kosong!',
        ]);


        $validatorIsiUlang = Validator::make($request->all(), [
            'galon_id' => 'required|array',
            'galon_id.*' => 'exists:tbl_galon,id',
            'jumlah' => 'required|numeric|min:1',
            'statusAntar_id' => 'required|exists:tbl_status_antar,id',
        ], [
            'galon_id.required' => 'Jenis galon tidak boleh kosong!',
            'jumlah.required' => 'Jumlah galon tidak boleh kosong!',
            'statusAntar_id.required' => 'Status isi ulang galon tidak boleh kosong!',
        ]);


        if ($validatorIsiUlang->fails()) {
            return back()->with('error', $validatorIsiUlang->messages()->all()[0])->withInput();
        }
        if ($validatorYa->fails()) {
            return back()->with('toast_error', $validatorYa->messages()->all()[0])->withInput();
        }

        if ($request->galon_id > 1) {
            $galon = Galon::findOrFail($request->galon_id);
            $totalHarga = $galon->sum('harga') * $request->jumlah;
        } else {
            $galon = Galon::findOrFail($request->galon_id);
            $totalHarga = $galon->harga * $request->jumlah;
        }

        $kode = now()->format('dmY') . 'GLIN' . now()->format('Hi');
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $kode;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->total_harga = $totalHarga;
        $transaksi->alamat = $request->alamat;
        $transaksi->noHp = $request->noHp;
        $transaksi->save();

        $status = statusAntar::findOrFail($request->statusAntar_id);

        if ($request->statusAntar_id == $yaValue) {
            $pengeluaran = new Pengeluaran();
            $pengeluaran->name = 'Fee Karyawan';
            $pengeluaran->harga = 500;
            $pengeluaran->jumlah = 0;
            $pengeluaran->keterangan = 'Antar Galon';
            $pengeluaran->save();
        }

        foreach ($request->galon_id as $galonId) {
            $galon = Galon::findOrFail($galonId);
            $subTotal = $galon->harga + $status->harga;

            $data = [
                'transaksi_id' => $transaksi->id,
                'galon_id' => $galonId,
                'status_id' => $request->statusAntar_id,
                'subTotal' => $subTotal,
            ];

            TransaksiDetail::create($data);
        }
        return redirect('transaksi')->with('success', 'Data berhasil disimpan!');
    }
}
