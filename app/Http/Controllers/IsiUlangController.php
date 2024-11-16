<?php

namespace App\Http\Controllers;

use App\Models\Galon;
use App\Models\IsiUlang;
use App\Models\statusAntar;
use Illuminate\Http\Request;

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
        $request->validate([
            'galon_id' => 'required|exists:tbl_galon,id',
            'jumlah' => 'required',
            'statusAntar_id' => 'required|exists:tbl_status_antar,id',
            'alamat' => 'nullable|string',
            'noHp' => 'nullable',
        ]);

        $galon = Galon::findOrFail($request->galon_id);


        $totalHarga = $galon->harga * $request->jumlah;

        $isiUlang = new IsiUlang();
        $isiUlang->galon_id = $request->galon_id;
        $isiUlang->jumlah = $request->jumlah;
        $isiUlang->statusAntar_id = $request->statusAntar_id;
        $isiUlang->alamat = $request->alamat;
        $isiUlang->noHp = $request->noHp;
        $isiUlang->save();

        return redirect();
    }

    /**
     * Display the specified resource.
     */
    public function show(IsiUlang $isiUlang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IsiUlang $isiUlang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IsiUlang $isiUlang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IsiUlang $isiUlang)
    {
        $isiUlang->delete();

        return redirect('statusA')->with('success', 'Data berhasil dihapus!');
    }
}
