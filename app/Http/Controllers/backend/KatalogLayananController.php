<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\KatalogLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $katalogLayanan = KatalogLayanan::latest()->get();
        return view('backend.katalog-layanan.index', compact('katalogLayanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.katalog-layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'url_video'   => 'nullable|url|max:255',
            'url_website' => 'nullable|url|max:255',
        ], [
            'title.required'     => 'Judul layanan wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'image.image'        => 'File harus berupa gambar.',
            'image.mimes'        => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'image.max'          => 'Ukuran gambar maksimal 2MB.',
            'url_video.url'      => 'Format URL video tidak valid.',
            'url_website.url'    => 'Format URL website tidak valid.',
        ]);

        // Upload image ke storage/app/public/katalog/layanan/
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('katalog/layanan', 'public');
        }

        KatalogLayanan::create($validated);

        return redirect()
            ->route('katalog-layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $katalogLayanan = KatalogLayanan::findOrFail($id);
        return view('backend.katalog-layanan.show', compact('katalogLayanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $katalogLayanan = KatalogLayanan::findOrFail($id);
        return view('backend.katalog-layanan.edit', compact('katalogLayanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $katalogLayanan = KatalogLayanan::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'url_video'   => 'nullable|url|max:255',
            'url_website' => 'nullable|url|max:255',
        ], [
            'title.required'     => 'Judul layanan wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'image.image'        => 'File harus berupa gambar.',
            'image.mimes'        => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'image.max'          => 'Ukuran gambar maksimal 2MB.',
            'url_video.url'      => 'Format URL video tidak valid.',
            'url_website.url'    => 'Format URL website tidak valid.',
        ]);

        // Upload image baru jika ada
        if ($request->hasFile('image')) {
            // Hapus image lama dari storage
            if ($katalogLayanan->image) {
                Storage::disk('public')->delete($katalogLayanan->image);
            }
            $validated['image'] = $request->file('image')->store('katalog/layanan', 'public');
        }

        $katalogLayanan->update($validated);

        return redirect()
            ->route('katalog-layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(string $id)
    {
        $katalogLayanan = KatalogLayanan::findOrFail($id);

        // Hapus image dari storage
        if ($katalogLayanan->image) {
            Storage::disk('public')->delete($katalogLayanan->image);
        }

        $katalogLayanan->delete();

        return redirect()
            ->route('katalog-layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}