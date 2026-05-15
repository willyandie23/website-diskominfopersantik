<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::orderBy('id', 'desc')->get();
        return view('backend.agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);
        Agenda::create($request->only('title', 'tanggal', 'keterangan'));
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
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
    public function edit(Agenda $agenda)
    {
        return view('backend.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);
        $agenda->update($request->only('title', 'tanggal', 'keterangan'));
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
