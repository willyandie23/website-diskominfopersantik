<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IdentityControler extends Controller
{
    /**
     * Daftar semua key yang dikelola.
     */
    protected array $keys = [
        'logo',
        'favicon',
        'instagram',
        'facebook',
        'youtube_url',
        'office_address',
        'office_phone',
        'office_email',
        'office_map',
    ];

    /**
     * Key yang berupa file upload.
     */
    protected array $fileKeys = ['logo', 'favicon'];

    // -------------------------------------------------------------------------
    // INDEX — tampilkan form + data existing
    // -------------------------------------------------------------------------
    public function index()
    {
        // Ambil semua data identity dan ubah menjadi koleksi key => value
        $identities = Identity::whereIn('key', $this->keys)
            ->pluck('value', 'key');

        return view('backend.identity.index', compact('identities'));
    }

    // -------------------------------------------------------------------------
    // STORE — simpan / perbarui semua field sekaligus (upsert per key)
    // -------------------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon'        => 'nullable|image|mimes:png,jpg,jpeg,ico,svg|max:2048',
            'instagram'      => 'nullable|url|max:255',
            'facebook'       => 'nullable|url|max:255',
            'youtube_url'    => 'nullable|url|max:255',
            'office_address' => 'nullable|string|max:500',
            'office_phone'   => 'nullable|string|max:30',
            'office_email'   => 'nullable|email|max:255',
            'office_map'     => 'nullable|string|max:2000',
        ], [
            'logo.image'          => 'Logo harus berupa file gambar.',
            'logo.mimes'          => 'Logo harus berformat PNG, JPG, JPEG, SVG, atau WebP.',
            'logo.max'            => 'Ukuran logo maksimal 2 MB.',
            'favicon.image'       => 'Favicon harus berupa file gambar.',
            'favicon.mimes'       => 'Favicon harus berformat PNG, JPG, ICO, atau SVG.',
            'favicon.max'         => 'Ukuran favicon maksimal 2 MB.',
            'instagram.url'       => 'Link Instagram harus berupa URL yang valid.',
            'facebook.url'        => 'Link Facebook harus berupa URL yang valid.',
            'youtube_url.url'     => 'Link YouTube harus berupa URL yang valid.',
            'office_email.email'  => 'Email kantor harus berupa alamat email yang valid.',
        ]);

        foreach ($this->keys as $key) {
            if (in_array($key, $this->fileKeys)) {
                // Proses upload file
                if ($request->hasFile($key) && $request->file($key)->isValid()) {
                    // Hapus file lama jika ada
                    $existing = Identity::where('key', $key)->first();
                    if ($existing && $existing->value) {
                        Storage::disk('public')->delete($existing->value);
                    }

                    $path = $request->file($key)->store("identity/{$key}", 'public');

                    $this->safeUpdateOrCreate($key, $path);
                }
                // Jika tidak ada file baru diunggah, data lama dipertahankan
            } else {
                // Proses input teks biasa
                if ($request->filled($key)) {
                    $this->safeUpdateOrCreate($key, $request->input($key));
                }
            }
        }

        return redirect()->route('identity.index')
            ->with('success', 'Identitas website berhasil disimpan.');
    }

    // -------------------------------------------------------------------------
    // DESTROY — hapus satu key-value tertentu
    // -------------------------------------------------------------------------
    public function destroy(string $key)
    {
        // Validasi key yang diizinkan untuk dihapus
        if (! in_array($key, $this->keys)) {
            return redirect()->route('identity.index')
                ->with('error', 'Key tidak dikenali.');
        }

        $identity = Identity::where('key', $key)->first();

        if (! $identity) {
            return redirect()->route('identity.index')
                ->with('error', 'Data tidak ditemukan.');
        }

        // Hapus file dari storage jika berupa file
        if (in_array($key, $this->fileKeys) && $identity->value) {
            Storage::disk('public')->delete($identity->value);
        }

        $identity->forceDelete();

        return redirect()->route('identity.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    // -------------------------------------------------------------------------
    // HELPER — upsert dengan kesadaran soft-delete
    // Jika record ditemukan (termasuk yang soft-deleted), restore + update.
    // Jika tidak ada sama sekali, buat baru.
    // Ini mencegah Duplicate Entry saat record pernah dihapus secara soft.
    // -------------------------------------------------------------------------
    protected function safeUpdateOrCreate(string $key, string $value): void
    {
        $existing = Identity::withTrashed()->where('key', $key)->first();

        if ($existing) {
            // Pulihkan jika soft-deleted, lalu perbarui nilainya
            if ($existing->trashed()) {
                $existing->restore();
            }
            $existing->update(['value' => $value]);
        } else {
            Identity::create(['key' => $key, 'value' => $value]);
        }
    }
}