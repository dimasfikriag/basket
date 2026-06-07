<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::latest()
            ->paginate(30);

        return view('admin.activity-logs.index', compact('logs'));
    }

    public function destroy($id)
    {
        $log = ActivityLog::findOrFail($id);
        $log->delete();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', 'Log aktivitas berhasil dihapus');
    }

    public function destroyOld(Request $request)
    {
        $days = $request->input('days', 30);

        $deleted = ActivityLog::where('created_at', '<', now()->subDays($days))
            ->delete();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', "Berhasil menghapus {$deleted} log aktivitas yang lebih lama dari {$days} hari");
    }
}
