<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Media::banner()->orderBy('id', 'desc')->get();

        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
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
            'slide_show' => 1,
            'hits' => 0,
        ]);

        return redirect()->route('banner.index')->with('success', 'Banner berhasil ditambahkan.');
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
    public function edit(Media $banner) // Route Model Binding
    {
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $banner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($banner->path);
            $file = $request->file('file');
            $banner->path = $file->store('uploads/media', 'public');
            $banner->file = $file->getMimeType();
        }

        $banner->name = $request->name;
        $banner->save();

        return redirect()->route('banner.index')
                        ->with('success', 'Banner berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $banner)
    {
        Storage::disk('public')->delete($banner->path);
        $banner->delete();

        return redirect()->route('banner.index')
                        ->with('success', 'Banner berhasil dihapus');
    }
}
