<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\KatalogFaq;
use Illuminate\Http\Request;

class KatalogFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = KatalogFaq::latest()->paginate(15);

        return view('backend.katalog-faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.katalog-faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        KatalogFaq::create($request->only(['title', 'deskripsi']));

        return redirect()
            ->route('katalog-faq.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KatalogFaq $katalogFaq)
    {
        return view('backend.katalog-faq.show', compact('katalogFaq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KatalogFaq $katalogFaq)
    {
        return view('backend.katalog-faq.edit', compact('katalogFaq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KatalogFaq $katalogFaq)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $katalogFaq->update($request->only(['title', 'deskripsi']));

        return redirect()
            ->route('katalog-faq.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KatalogFaq $katalogFaq)
    {
        $katalogFaq->delete();

        return redirect()
            ->route('katalog-faq.index')
            ->with('success', 'FAQ berhasil dihapus!');
    }
}