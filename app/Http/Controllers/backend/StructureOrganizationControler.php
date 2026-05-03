<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StructureOrganizationControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = StructureOrganization::with('field')
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.structure-organization.index', compact('structures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fields = Field::orderBy('id')->get();
        return view('backend.structure-organization.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'jabatan'     => 'required|string|max:255',
            'golongan'    => 'nullable|string|max:100',
            'field_id'    => 'nullable|exists:fields,id',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active'   => 'boolean',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('uploads/structure', 'public');
        }

        StructureOrganization::create([
            'nama'        => $request->nama,
            'jabatan'     => $request->jabatan,
            'golongan'    => $request->golongan,
            'field_id'    => $request->field_id,
            'gambar'      => $path,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('structure-organization.index')
            ->with('success', 'Data struktur organisasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StructureOrganization $strukturOrganisasi)
    {
        $fields = Field::orderBy('id')->get();
        return view('backend.structure-organization.edit', compact('strukturOrganisasi', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StructureOrganization $strukturOrganisasi)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'jabatan'     => 'required|string|max:255',
            'golongan'    => 'nullable|string|max:100',
            'field_id'    => 'nullable|exists:fields,id',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($strukturOrganisasi->gambar) {
                Storage::disk('public')->delete($strukturOrganisasi->gambar);
            }
            $strukturOrganisasi->gambar = $request->file('gambar')->store('uploads/structure', 'public');
        }

        $strukturOrganisasi->update([
            'nama'        => $request->nama,
            'jabatan'     => $request->jabatan,
            'golongan'    => $request->golongan,
            'field_id'    => $request->field_id,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('structure-organization.index')
            ->with('success', 'Data struktur organisasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StructureOrganization $strukturOrganisasi)
    {
        if ($strukturOrganisasi->gambar) {
            Storage::disk('public')->delete($strukturOrganisasi->gambar);
        }

        $strukturOrganisasi->delete();

        return redirect()->route('structure-organization.index')
            ->with('success', 'Data struktur organisasi berhasil dihapus.');
    }
}
