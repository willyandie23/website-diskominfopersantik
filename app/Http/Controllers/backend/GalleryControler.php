<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Media::gallery()->orderBy('id', 'desc')->get();
        
        return view('backend.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads/media', 'public');

        Media::create([
            'name' => $request->name,
            'file' => $file->getMimeType(),
            'path' => $path,
            'slide_show' => 0,
            'hits' => 0,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil ditambahkan.');
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
    public function edit(Media $galeri)
    {
        return view('backend.gallery.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $galeri)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($galeri->path);

            // Simpan file baru
            $file = $request->file('file');
            $galeri->path = $file->store('uploads/media', 'public');
            $galeri->file = $file->getMimeType();
        }

        $galeri->name = $request->name;
        $galeri->save();

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $galeri)
    {
        Storage::disk('public')->delete($galeri->path);
        $galeri->delete();

        return redirect()->route('gallery.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
