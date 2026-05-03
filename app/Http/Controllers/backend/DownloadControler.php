<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $downloads = Media::download()->orderBy('id', 'desc')->get();
        
        return view('backend.download.index', compact('downloads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.download.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads/download', 'public');

        Media::create([
            'name'       => $request->name,
            'file'       => $file->getMimeType(),
            'path'       => $path,
            'slide_show' => 0,
            'hits'       => 0,
        ]);

        return redirect()->route('download.index')->with('success', 'File unduhan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $unduhan)
    {
        return view('backend.download.edit', compact('unduhan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $unduhan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($unduhan->path);
            $file = $request->file('file');
            $unduhan->path = $file->store('uploads/download', 'public');
            $unduhan->file = $file->getMimeType();
        }

        $unduhan->name = $request->name;
        $unduhan->save();

        return redirect()->route('download.index')->with('success', 'File unduhan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $unduhan)
    {
        Storage::disk('public')->delete($unduhan->path);
        $unduhan->delete();

        return redirect()->route('download.index')->with('success', 'File unduhan berhasil dihapus.');
    }

    /**
     * Download file + tambah counter hits
     */
    public function downloadFile(Media $media)
    {
        // Pastikan ini adalah file unduhan (bukan gambar)
        if (!$media->getIsDownloadAttribute()) {
            abort(404);
        }

        // Tambah counter hits
        $media->increment('hits');

        // Ambil ekstensi asli dari file (pdf, docx, dll)
        $extension = pathinfo($media->path, PATHINFO_EXTENSION);

        // Buat nama file download menggunakan kolom 'name' + ekstensi
        $downloadName = $media->name . '.' . $extension;

        // Download dengan nama yang diinginkan
        return Storage::disk('public')->download($media->path, $downloadName);
    }
}