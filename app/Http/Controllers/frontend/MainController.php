<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Field;
use App\Models\Media;
use App\Models\News;
use App\Models\StructureOrganization;

class MainController extends Controller
{
    public function index()
    {
        $banners = Media::banner()->latest()->get();

        $stats = [
            'pegawai' => StructureOrganization::where('is_active', true)->count(),
            'bidang' => Field::count() - 1,
            'berita' => News::count(),
        ];

        $agendas = Agenda::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->limit(5)
            ->get();

        $news = News::latest()->limit(4)->get();

        $galleries = Media::gallery()->latest()->limit(9)->get();
        $downloads = Media::download()->latest()->limit(4)->get();

        $kepalaDinas = StructureOrganization::where('is_active', true)
            ->whereRaw("LOWER(jabatan) LIKE '%kepala dinas%'")
            ->first();

        return view('frontend.main.index', compact('banners', 'stats', 'agendas', 'news', 'galleries', 'downloads', 'kepalaDinas'));
    }
}
