<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Options;
use App\Models\Requests;
use App\Models\RequestHistory;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    /**
     * Tampilkan daftar semua pengajuan.
     */
    public function index()
    {
        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value');

        $categories = Options::where('type', 'HELPDESK_CATEGORY_REQUEST')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value');

        $requests = Requests::with('latestHistory')
            ->latest()
            ->get();

        return view('backend.helpdesk.requests.index', compact('requests', 'statuses', 'categories'));
    }

    /**
     * Tampilkan detail pengajuan beserta riwayat statusnya.
     */
    public function show(string $id)
    {
        $requestData = Requests::with(['histories'])->findOrFail($id);

        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value');

        $category = Options::where('type', 'HELPDESK_CATEGORY_REQUEST')
            ->where('value', $requestData->category)
            ->whereNull('deleted_at')
            ->first();

        return view('backend.helpdesk.requests.show', compact('requestData', 'statuses', 'category'));
    }

    /**
     * Update status pengajuan dan tambahkan history baru.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string',
        ], [
            'status.required' => 'Status wajib dipilih.',
        ]);

        $requestData = Requests::findOrFail($id);

        // Cegah update jika status sama
        if ($requestData->status === $request->status) {
            return back()->with('warning', 'Status tidak berubah, pilih status yang berbeda.');
        }

        // Update status di tabel utama
        $requestData->update([
            'status' => $request->status,
        ]);

        // Catat history perubahan status
        RequestHistory::create([
            'ref_id' => $requestData->id,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pengajuan #' . $requestData->id . ' berhasil diperbarui.');
    }

    /**
     * Hapus pengajuan (soft delete).
     */
    public function destroy(string $id)
    {
        $requestData = Requests::findOrFail($id);
        $requestData->delete();

        return redirect()
            ->route('requests.index')
            ->with('success', 'Pengajuan #' . $id . ' berhasil dihapus.');
    }

    // Tidak digunakan
    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
}