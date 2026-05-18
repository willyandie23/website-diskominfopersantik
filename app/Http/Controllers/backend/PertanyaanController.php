<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::withCount('votes')->latest()->get();
        return view('backend.pertanyaan.index', compact('pertanyaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'is_active'  => 'nullable|boolean',
        ]);
        Pertanyaan::create([
            'pertanyaan' => $validated['pertanyaan'],
            'is_active'  => $request->has('is_active') ? true : false,
        ]);
        return redirect()->route('pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
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
    public function edit(Pertanyaan $pertanyaan)
    {
        return view('backend.pertanyaan.edit', compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'is_active'  => 'nullable|boolean',
        ]);
        $pertanyaan->update([
            'pertanyaan' => $validated['pertanyaan'],
            'is_active'  => $request->has('is_active') ? true : false,
        ]);
        return redirect()->route('pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        if ($pertanyaan->votes()->count() > 0) {
            return redirect()->route('pertanyaan.index')
                ->with('error', 'Pertanyaan tidak dapat dihapus karena masih memiliki data votes.');
        }
        $pertanyaan->delete();
        return redirect()->route('pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
