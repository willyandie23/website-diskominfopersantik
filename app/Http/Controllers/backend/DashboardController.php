<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\News;
use App\Models\Statistics;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalDownloads = Media::download()->count();
        $totalGalleries = Media::gallery()->count();
        $totalNews      = News::count();
        $totalVisitors  = Statistics::count();

        $visitorChart = Statistics::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $visitorChart->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        })->toArray();

        $chartData = $visitorChart->pluck('total')->toArray();

        return view('backend.dashboard.index', compact(
            'totalDownloads',
            'totalGalleries',
            'totalNews',
            'totalVisitors',
            'chartLabels',
            'chartData'
        ));
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
        //
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
