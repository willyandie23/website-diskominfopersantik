<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AppLog;
use Illuminate\Http\Request;

class AppLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = AppLog::with('user')->latest();
            if ($request->module_name) {
                $query->where('module_name', $request->module_name);
            }
            if ($request->action) {
                $query->where('action', $request->action);
            }
            if ($request->date_from) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->date_to) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }
            $logs = $query->get()->map(function ($log) {
                return [
                    'id'          => $log->id,
                    'created_at'  => $log->created_at->format('d M Y H:i:s'),
                    'user_name'   => $log->user->name ?? '-',
                    'module_name' => $log->module_name,
                    'action'      => $log->action,
                    'ip_address'  => $log->ip_address,
                ];
            });
            return response()->json(['data' => $logs]);
        }
        return view('backend.logs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = AppLog::with('user')->findOrFail($id);
        if (request()->ajax()) {
            return response()->json([
                'created_at'  => $log->created_at->format('d M Y H:i:s'),
                'user_name'   => $log->user->name ?? '-',
                'guard_name'  => $log->guard_name,
                'module_name' => $log->module_name,
                'action'      => $log->action,
                'ip_address'  => $log->ip_address,
                'old_value'   => $log->old_value,
                'new_value'   => $log->new_value,
            ]);
        }
        return view('backend.logs.show', compact('log'));
    }

}
