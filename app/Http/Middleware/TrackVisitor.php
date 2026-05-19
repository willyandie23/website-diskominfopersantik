<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Statistics;
use Jenssegers\Agent\Agent;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lewati jika request bukan GET atau ke route admin / api (sesuaikan kebutuhanmu)
        if ($request->isMethod('get') && 
            !str_starts_with($request->path(), 'admin') && 
            !$request->is('api/*')) {

            $agent = new Agent();
            $agent->setUserAgent($request->userAgent());

            // Hindari duplikat dalam 1 menit yang sama untuk IP yang sama (opsional tapi sangat direkomendasikan)
            $exists = Statistics::where('ip', $request->ip())
                ->where('created_at', '>=', now()->subMinute())
                ->exists();

            if (!$exists) {
                Statistics::create([
                    'ip'      => $request->ip(),
                    'os'      => $agent->platform(),      // contoh: "Windows", "Android", "macOS"
                    'browser' => $agent->browser(),       // contoh: "Chrome", "Firefox", "Safari"
                ]);
            }
        }

        return $next($request);
    }
}