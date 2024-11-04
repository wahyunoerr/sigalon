<?php

namespace App\Http\Controllers;

use App\Models\statusAntar;
use Illuminate\Http\Request;

class StatusAntarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = statusAntar::all();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin?";
        confirmDelete($title, $text);

        return view('pages.statusAntar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.statusAntar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'harga' => 'required'
        ]);

        statusAntar::create([
            'name' => $request->name,
            'harga' => $request->harga
        ]);

        return redirect('statusA')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(statusAntar $statusAntar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(statusAntar $statusAntar)
    {
        return view('pages.statusAntar.edit', compact('statusAntar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, statusAntar $statusAntar)
    {
        $request->validate([
            'name' => 'required|string',
            'harga' => 'required'
        ]);

        $statusAntar->update([
            'name' => $request->name,
            'harga' => $request->harga
        ]);

        return redirect('statusA')->with('success', 'Data berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(statusAntar $statusAntar)
    {
        $statusAntar->delete();

        return redirect('statusA')->with('success', 'Data berhasil dihapus!');
    }
}
