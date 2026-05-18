<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\Votes;
use Illuminate\Http\Request;

class JajakPendapatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::where('is_active', true)
            ->withCount([
                'votes',
                'votes as votes_biasa_count' => fn($q) => $q->where('nilai_vote', 1),
                'votes as votes_bagus_count' => fn($q) => $q->where('nilai_vote', 2),
                'votes as votes_sangat_bagus_count' => fn($q) => $q->where('nilai_vote', 3),
            ])
            ->latest()
            ->get();
        return view('frontend.jajak-pendapat.index', compact('pertanyaans'));
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
        $validated = $request->validate([
            'pertanyaan_id' => 'required|exists:pertanyaans,id',
            'nilai_vote'    => 'required|in:1,2,3',
        ]);
        // Kumpulkan data pengguna
        $userInformation = [
            'remote_address' => $request->ip(),
            'computer_name'  => gethostbyaddr($request->ip()),
            'server_name'    => $request->server('SERVER_NAME'),
            'user_agent'     => $request->userAgent(),
            'http_referer'   => $request->server('HTTP_REFERER'),
            'os'             => $this->getOS($request->userAgent()),
            'browser'        => $this->getBrowser($request->userAgent()),
        ];
        // Cek apakah IP sudah pernah vote untuk pertanyaan ini (opsional, anti-spam)
        $alreadyVoted = Votes::where('pertanyaan_id', $validated['pertanyaan_id'])
            ->whereJsonContains('data_pengguna->remote_address', $request->ip())
            ->exists();
        if ($alreadyVoted) {
            return back()->with('error', 'Anda sudah pernah memberikan vote untuk pertanyaan ini.')
                ->withFragment('pertanyaan-' . $validated['pertanyaan_id']);
        }
        Votes::create([
            'pertanyaan_id' => $validated['pertanyaan_id'],
            'nilai_vote'    => $validated['nilai_vote'],
            'data_pengguna' => json_encode($userInformation),
        ]);
        return back()->with('success', 'Terima kasih! Vote Anda berhasil disimpan.')
            ->withFragment('pertanyaan-' . $validated['pertanyaan_id']);
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

    private function getOS($userAgent)
    {
        $osList = [
            '/windows nt 10/i'    => 'Windows 10',
            '/windows nt 11/i'    => 'Windows 11',
            '/windows nt 6.3/i'   => 'Windows 8.1',
            '/windows nt 6.2/i'   => 'Windows 8',
            '/windows nt 6.1/i'   => 'Windows 7',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/linux/i'            => 'Linux',
            '/ubuntu/i'           => 'Ubuntu',
            '/iphone/i'           => 'iPhone',
            '/android/i'          => 'Android',
        ];
        foreach ($osList as $regex => $value) {
            if (preg_match($regex, $userAgent)) return $value;
        }
        return 'Unknown OS';
    }
    private function getBrowser($userAgent)
    {
        $browserList = [
            '/edge/i'    => 'Edge',
            '/opr/i'     => 'Opera',
            '/chrome/i'  => 'Chrome',
            '/firefox/i' => 'Firefox',
            '/safari/i'  => 'Safari',
            '/msie/i'    => 'Internet Explorer',
        ];
        foreach ($browserList as $regex => $value) {
            if (preg_match($regex, $userAgent)) return $value;
        }
        return 'Unknown Browser';
    }
}
