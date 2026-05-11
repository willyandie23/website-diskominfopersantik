<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use App\Models\CasesHistory;
use App\Models\Options;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    /**
     * Tampilkan daftar semua keluhan.
     */
    public function index()
    {
        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value');

        $categories = Options::where('type', 'HELPDESK_CATEGORY_CASE')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value');

        $cases = Cases::with('latestHistory')
            ->latest()
            ->get();

        return view('backend.helpdesk.cases.index', compact('cases', 'statuses', 'categories'));
    }

    /**
     * Tampilkan detail keluhan beserta riwayat statusnya.
     */
    public function show(string $id)
    {
        $case = Cases::with(['histories'])->findOrFail($id);

        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value');

        $category = Options::where('type', 'HELPDESK_CATEGORY_CASE')
            ->where('value', $case->category)
            ->whereNull('deleted_at')
            ->first();

        return view('backend.helpdesk.cases.show', compact('case', 'statuses', 'category'));
    }

    /**
     * Update status keluhan dan tambahkan history baru.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string',
        ], [
            'status.required' => 'Status wajib dipilih.',
        ]);

        $case = Cases::findOrFail($id);

        // Cegah update jika status sama
        if ($case->status === $request->status) {
            return back()->with('warning', 'Status tidak berubah, pilih status yang berbeda.');
        }

        // Update status di tabel utama
        $case->update([
            'status'     => $request->status,
            'updated_by' => auth()->id(),
        ]);

        // Catat history perubahan status
        CasesHistory::create([
            'ref_id' => $case->id,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status keluhan #' . $case->id . ' berhasil diperbarui.');
    }

    /**
     * Hapus keluhan (soft delete).
     */
    public function destroy(string $id)
    {
        $case = Cases::findOrFail($id);

        $case->update(['deleted_by' => auth()->id()]);
        $case->delete();

        return redirect()
            ->route('cases.index')
            ->with('success', 'Keluhan #' . $id . ' berhasil dihapus.');
    }

    // Tidak digunakan
    public function create() {}
    public function store(Request $request) {}
    public function edit(string $id) {}
}