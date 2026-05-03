<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('id', 'desc')->get();

        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/news', 'public');
        }

        News::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'image'       => $imagePath,
            'created_by'  => auth()->id(),
            'counter'     => 0,
            'flag'        => 'kegiatan',
        ]);

        return redirect()->route('news.index')
                            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $beritum)
    {
        return view('backend.news.edit', compact('beritum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $beritum)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($beritum->image) {
                Storage::disk('public')->delete($beritum->image);
            }
            $beritum->image = $request->file('image')->store('uploads/news', 'public');
        }

        $beritum->update([
            'title'   => $request->title,
            'content' => $request->content,
            // created_by dan flag tidak boleh diubah
        ]);

        return redirect()->route('news.index')
                            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $beritum)
    {
        if ($beritum->image) {
            Storage::disk('public')->delete($beritum->image);
        }

        $beritum->delete();

        return redirect()->route('news.index')
                            ->with('success', 'Berita berhasil dihapus.');
    }
}
