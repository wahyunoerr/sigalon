<?php

namespace App\Http\Controllers;

use App\Models\Galon;
use App\Models\Pengeluaran;
use App\Models\statusAntar;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pelanggan;
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
        $pelanggan = Pelanggan::all();

        return view('pages.transaksi.galon.isiulang', compact('data', 'statusA', 'pelanggan'));
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
        $validatorIsiUlang = Validator::make($request->all(), [
            'galon_id' => 'required|array',
            'galon_id.*' => 'exists:tbl_galon,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'nullable|numeric|min:1',
            'statusAntar_id' => 'required|exists:tbl_status_antar,id',
            'pelanggan_id' => 'required',
            'name' => 'required_if:pelanggan_id,new|string',
            'alamat' => 'required_if:pelanggan_id,new|string',
            'noHp' => 'required_if:pelanggan_id,new|numeric',
        ], [
            'galon_id.required' => 'Jenis galon tidak boleh kosong!',
            'jumlah.required' => 'Jumlah galon tidak boleh kosong!',
            'jumlah.*.numeric' => 'Jumlah galon harus berupa angka!',
            'jumlah.*.min' => 'Jumlah galon minimal 1!',
            'statusAntar_id.required' => 'Status isi ulang galon tidak boleh kosong!',
            'pelanggan_id.required' => 'Pelanggan harus dipilih!',
            'name.required_if' => 'Nama pelanggan tidak boleh kosong!',
            'alamat.required_if' => 'Alamat pelanggan tidak boleh kosong untuk pelanggan baru!',
            'noHp.required_if' => 'Nomor telepon pelanggan tidak boleh kosong untuk pelanggan baru!',
        ]);

        if ($validatorIsiUlang->fails()) {
            return back()->with('error', $validatorIsiUlang->messages()->all()[0])->withInput();
        }

        $pelanggan = null;
        if ($request->pelanggan_id === 'new') {
            $pelanggan = Pelanggan::create([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'noHp' => $request->noHp,
            ]);
        } else {
            $pelanggan = Pelanggan::findOrFail($request->pelanggan_id);
        }

        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = now()->format('dmY') . 'GLIN' . now()->format('Hi');
        $transaksi->jumlah = collect($request->galon_id)->sum(function ($galonId) use ($request) {
            return $request->jumlah[$galonId];
        });
        $transaksi->total_harga = collect($request->galon_id)->sum(function ($galonId) use ($request) {
            $galon = Galon::findOrFail($galonId);
            return $galon->harga * $request->jumlah[$galonId];
        });
        $transaksi->save();

        foreach ($request->galon_id as $galonId) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'galon_id' => $galonId,
                'pelanggan_id' => $pelanggan->id,
                'jumlah' => $request->jumlah[$galonId],
                'status_id' => $request->statusAntar_id,
                'subTotal' => Galon::findOrFail($galonId)->harga * $request->jumlah[$galonId],
            ]);
        }

        return redirect('transaksi')->with('success', 'Data berhasil disimpan!');
    }
}
