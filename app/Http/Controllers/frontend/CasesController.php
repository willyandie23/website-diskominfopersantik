<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use App\Models\CasesHistory;
use App\Models\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CasesController extends Controller
{
    /**
     * Tampilkan halaman daftar & form pengajuan keluhan.
     */
    public function index()
    {
        $categories = Options::where('type', 'HELPDESK_CATEGORY_CASE')
            ->whereNull('deleted_at')
            ->get();

        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get();

        return view('frontend.cases.index', compact('categories', 'statuses'));
    }

    /**
     * Simpan keluhan baru yang diajukan oleh pengguna.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'category'              => 'required|string',
            'unit_name'             => 'required|string|max:255',
            'requester_name'        => 'required|string|max:255',
            'nip'                   => 'nullable|string|max:50',
            'phone'                 => 'required|string|max:20',
            'email'                 => 'required|email|max:255',
            'deadline_by_requester' => 'nullable|date',
            'desc'                  => 'required|string',
            'file_attachment'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'title.required'          => 'Judul keluhan wajib diisi.',
            'category.required'       => 'Kategori keluhan wajib dipilih.',
            'unit_name.required'      => 'Nama unit/instansi wajib diisi.',
            'requester_name.required' => 'Nama pelapor wajib diisi.',
            'phone.required'          => 'Nomor telepon wajib diisi.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
            'desc.required'           => 'Deskripsi keluhan wajib diisi.',
            'file_attachment.mimes'   => 'File harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_attachment.max'     => 'Ukuran file maksimal 5MB.',
        ]);

        // Upload file lampiran ke public/storage/lampiran/
        $filePath = null;
        if ($request->hasFile('file_attachment')) {
            $file      = $request->file('file_attachment');
            $fileName  = time() . '_' . Str::slug(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            ) . '.' . $file->getClientOriginalExtension();

            // Pastikan folder sudah ada, jika belum buat otomatis
            $destination = public_path('storage/lampiran');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $fileName);
            $filePath = 'lampiran/' . $fileName;
        }

        // Buat keluhan baru dengan status awal 'sent'
        $case = Cases::create([
            'title'                 => $validated['title'],
            'category'              => $validated['category'],
            'unit_name'             => $validated['unit_name'],
            'requester_name'        => $validated['requester_name'],
            'nip'                   => $validated['nip'] ?? null,
            'phone'                 => $validated['phone'],
            'email'                 => $validated['email'],
            'deadline_by_requester' => $validated['deadline_by_requester'] ?? null,
            'desc'                  => $validated['desc'],
            'file_attachment'       => $filePath,
            'status'                => 'sent',
        ]);

        // Buat history awal otomatis
        CasesHistory::create([
            'ref_id' => $case->id,
            'status' => 'sent',
        ]);

        return redirect()
            ->route('frontend.cases.show', $case->id)
            ->with('success', 'Keluhan berhasil dikirim! Catat nomor tiket Anda: #' . $case->id);
    }

    /**
     * Tampilkan detail keluhan beserta riwayat statusnya.
     */
    public function show(string $id)
    {
        $case = Cases::with(['histories'])->findOrFail($id);

        // Ambil semua status untuk kebutuhan mapping label & badge
        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value'); // $statuses['sent']->label, $statuses['sent']->value2

        // Ambil label kategori keluhan
        $category = Options::where('type', 'HELPDESK_CATEGORY_CASE')
            ->where('value', $case->category)
            ->whereNull('deleted_at')
            ->first();

        return view('frontend.cases.show', compact('case', 'statuses', 'category'));
    }

    /**
     * Halaman pencarian tiket keluhan berdasarkan ID.
     */
    public function track(Request $request)
    {
        if ($request->filled('ticket_id')) {
            $request->validate([
                'ticket_id' => 'required|integer',
            ], [
                'ticket_id.required' => 'Nomor tiket wajib diisi.',
                'ticket_id.integer'  => 'Nomor tiket harus berupa angka.',
            ]);

            $case = Cases::with(['histories'])
                ->find($request->ticket_id);

            if (!$case) {
                return back()->withErrors([
                    'ticket_id' => 'Nomor tiket #' . $request->ticket_id . ' tidak ditemukan.',
                ])->withInput();
            }

            return redirect()->route('frontend.cases.show', $case->id);
        }

        return view('frontend.cases.track');
    }

    // Tidak digunakan di frontend publik
    public function create() {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}