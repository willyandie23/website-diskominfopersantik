<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\KatalogFaq;
use App\Models\KatalogLayanan;
use Illuminate\Http\Request;

class KatalogLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $katalogs = KatalogLayanan::latest()->get();
        $faqs = KatalogFaq::latest()->get();
        return view('frontend.katalog-layanan.index', compact('katalogs', 'faqs'));
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
}
