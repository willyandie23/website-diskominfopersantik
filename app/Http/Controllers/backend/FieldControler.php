<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Field::orderBy('id', 'asc')->get();
        
        return view('backend.field.index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.field.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang'       => 'required|string|max:255|unique:fields,nama_bidang',
            'deskripsi_bidang'  => 'nullable|string',
        ]);

        Field::create([
            'nama_bidang'      => $request->nama_bidang,
            'deskripsi_bidang' => $request->deskripsi_bidang,
        ]);

        return redirect()->route('field.index')
                            ->with('success', 'Bidang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $bidang)
    {
        return view('backend.field.edit', compact('bidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Field $bidang)
    {
        $request->validate([
            'nama_bidang'       => 'required|string|max:255|unique:fields,nama_bidang,' . $bidang->id,
            'deskripsi_bidang'  => 'nullable|string',
        ]);

        $bidang->update([
            'nama_bidang'      => $request->nama_bidang,
            'deskripsi_bidang' => $request->deskripsi_bidang,
        ]);

        return redirect()->route('field.index')
                            ->with('success', 'Bidang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $bidang)
    {
        $bidang->delete();

        return redirect()->route('field.index')
                            ->with('success', 'Bidang berhasil dihapus.');
    }
}
