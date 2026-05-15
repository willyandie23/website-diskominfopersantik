<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Options;
use App\Models\Requests;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestsController extends Controller
{
    /**
     * Tampilkan halaman form pengajuan.
     */
    public function index()
    {
        $categories = Options::where('type', 'HELPDESK_CATEGORY_REQUEST')
            ->whereNull('deleted_at')
            ->get();

        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get();
        
        $requests = Requests::select('id', 'requester_name', 'unit_name', 'title', 'category', 'status')
            ->latest()
            ->get();

        return view('frontend.requests.index', compact('categories', 'statuses', 'requests'));
    }

    /**
     * Simpan pengajuan baru yang diajukan oleh pengguna.
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
            'file_surat_pengantar'  => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_addition1'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_addition2'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_addition3'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'title.required'                => 'Judul pengajuan wajib diisi.',
            'category.required'             => 'Kategori pengajuan wajib dipilih.',
            'unit_name.required'            => 'Nama unit/instansi wajib diisi.',
            'requester_name.required'       => 'Nama pengaju wajib diisi.',
            'phone.required'                => 'Nomor telepon wajib diisi.',
            'email.required'                => 'Email wajib diisi.',
            'email.email'                   => 'Format email tidak valid.',
            'desc.required'                 => 'Deskripsi pengajuan wajib diisi.',
            'file_surat_pengantar.required' => 'Surat pengantar wajib dilampirkan.',
            'file_surat_pengantar.mimes'    => 'Surat pengantar harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_surat_pengantar.max'      => 'Ukuran surat pengantar maksimal 5MB.',
            'file_addition1.mimes'          => 'File tambahan 1 harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_addition1.max'            => 'Ukuran file tambahan 1 maksimal 5MB.',
            'file_addition2.mimes'          => 'File tambahan 2 harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_addition2.max'            => 'Ukuran file tambahan 2 maksimal 5MB.',
            'file_addition3.mimes'          => 'File tambahan 3 harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_addition3.max'            => 'Ukuran file tambahan 3 maksimal 5MB.',
        ]);

        // Pastikan folder tujuan sudah ada
        $destination = public_path('storage/lampiran');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        /**
         * Helper upload file ke public/storage/lampiran/
         * Mengembalikan path relatif atau null jika tidak ada file.
         */
        $uploadFile = function (string $inputName) use ($request, $destination): ?string {
            if (!$request->hasFile($inputName)) {
                return null;
            }

            $file     = $request->file($inputName);
            $fileName = time() . '_' . Str::slug(
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            ) . '.' . $file->getClientOriginalExtension();

            $file->move($destination, $fileName);

            return 'lampiran/' . $fileName;
        };

        // Upload semua file
        $fileSuratPengantar = $uploadFile('file_surat_pengantar');
        $fileAddition1      = $uploadFile('file_addition1');
        $fileAddition2      = $uploadFile('file_addition2');
        $fileAddition3      = $uploadFile('file_addition3');

        // Buat pengajuan baru dengan status awal 'sent'
        $requestData = Requests::create([
            'title'                 => $validated['title'],
            'category'              => $validated['category'],
            'unit_name'             => $validated['unit_name'],
            'requester_name'        => $validated['requester_name'],
            'nip'                   => $validated['nip'] ?? null,
            'phone'                 => $validated['phone'],
            'email'                 => $validated['email'],
            'deadline_by_requester' => $validated['deadline_by_requester'] ?? null,
            'desc'                  => $validated['desc'],
            'status'                => 'sent',
            'file_surat_pengantar'  => $fileSuratPengantar,
            'file_addition1'        => $fileAddition1,
            'file_addition2'        => $fileAddition2,
            'file_addition3'        => $fileAddition3,
        ]);

        // Buat history awal otomatis
        RequestHistory::create([
            'ref_id' => $requestData->id,
            'status' => 'sent',
        ]);

        return redirect()
            ->route('frontend.requests.show', $requestData->id)
            ->with('success', 'Pengajuan berhasil dikirim! Catat nomor tiket Anda: #' . $requestData->id);
    }

    /**
     * Tampilkan detail pengajuan beserta riwayat statusnya.
     */
    public function show(string $id)
    {
        $requestData = Requests::with(['histories'])->findOrFail($id);

        // Mapping status untuk label & badge
        $statuses = Options::where('type', 'HELPDESK_STATUS')
            ->whereNull('deleted_at')
            ->get()
            ->keyBy('value');

        // Label kategori pengajuan
        $category = Options::where('type', 'HELPDESK_CATEGORY_REQUEST')
            ->where('value', $requestData->category)
            ->whereNull('deleted_at')
            ->first();

        return view('frontend.requests.show', compact('requestData', 'statuses', 'category'));
    }

    /**
     * Lacak status tiket pengajuan berdasarkan ID.
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

            $requestData = Requests::with(['histories'])
                ->find($request->ticket_id);

            if (!$requestData) {
                return back()->withErrors([
                    'ticket_id' => 'Nomor tiket #' . $request->ticket_id . ' tidak ditemukan.',
                ])->withInput();
            }

            return redirect()->route('frontend.requests.show', $requestData->id);
        }

        return view('frontend.requests.track');
    }

    // Tidak digunakan di frontend publik
    public function create() {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}