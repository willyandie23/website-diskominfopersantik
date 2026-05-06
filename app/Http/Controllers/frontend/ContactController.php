<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Identity;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officeMap = Identity::where('key', 'office_map')->value('value');
        $mapUrl = null;
        if ($officeMap) {
            preg_match('/src="([^"]+)"/', $officeMap, $matches);
            $mapUrl = $matches[1] ?? null;
        }
        $address = Identity::where('key', 'office_address')->value('value');
        $phone = Identity::where('key', 'office_phone')->value('value');
        $mail = Identity::where('key', 'office_email')->value('value');

        return view('frontend.contact.index', compact('mapUrl', 'address', 'phone', 'mail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => ['required', 'string', 'max:100', function ($attribute, $value, $fail) {
                $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
                $isPhone = preg_match('/^(\+62|62|0)[0-9]{8,13}$/', $value);
                if (!$isEmail && !$isPhone) {
                    $fail('Masukkan alamat email yang valid atau nomor HP/WA (contoh: 08123456789).');
                }
            }],
            'subjek' => 'required|string|max:150',
            'isi'    => 'required|string',
        ], [
            'nama.required'   => 'Nama wajib diisi.',
            'email.required'  => 'Email atau nomor HP/WA wajib diisi.',
            'subjek.required' => 'Subjek wajib diisi.',
            'isi.required'    => 'Isi pesan wajib diisi.',
        ]);
        Contact::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'subjek' => $request->subjek,
            'isi'    => $request->isi,
        ]);
        return redirect()->route('frontend.contact.index')
            ->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
