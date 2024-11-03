<?php

namespace App\Http\Controllers;

use App\Models\Galon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galon = Galon::all();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        return view('pages.galon.index', compact('galon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.galon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaGalon' => 'required',
            'harga' => 'required'
        ]);

        Galon::create([
            'name' => $request->namaGalon,
            'harga' => $request->harga
        ]);

        return redirect('galon')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galon $galon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galon $galon)
    {
        return view('pages.galon.edit', compact('galon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galon $galon)
    {
        $request->validate([
            'namaGalon' => 'required',
            'harga' => 'required'
        ]);

        $galon->update([
            'name' => $request->namaGalon,
            'harga' => $request->harga
        ]);

        return redirect('galon')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galon $galon)
    {
        $galon->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
