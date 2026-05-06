<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;

class StructureOrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua pegawai aktif
        $pegawai = StructureOrganization::where('is_active', true)
            ->orderBy('id', 'asc')
            ->get();
        // Kelompokkan berdasarkan keyword di jabatan
        $kepalaDinas = $pegawai->filter(fn($p) => str_contains(strtolower($p->jabatan), 'kepala dinas'));
        $sekretaris  = $pegawai->filter(fn($p) => str_contains(strtolower($p->jabatan), 'sekretaris'));
        $kabid       = $pegawai->filter(fn($p) => 
            str_contains(strtolower($p->jabatan), 'kepala bidang') || 
            str_contains(strtolower($p->jabatan), 'kabid')
        );
        $kasubag     = $pegawai->filter(fn($p) => 
            str_contains(strtolower($p->jabatan), 'kasubag') || 
            str_contains(strtolower($p->jabatan), 'kepala sub bagian')
        );
        // Staff = sisanya yang tidak masuk kategori di atas
        $classified = $kepalaDinas->merge($sekretaris)->merge($kabid)->merge($kasubag)->pluck('id');
        $staff = $pegawai->whereNotIn('id', $classified);
        return view('frontend.structure-organization.index', compact(
            'kepalaDinas', 'sekretaris', 'kabid', 'kasubag', 'staff'
        ));
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showByField($id)
    {
        $field = Field::with(['structures' => function ($query) {
            $query->where('is_active', true)->orderBy('id', 'asc');
        }])->findOrFail($id);
        return view('frontend.field.show', compact('field'));
    }
}
