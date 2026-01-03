<?php

namespace App\Modules\ActivityLog\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ActivityLog\Models\ActivityLog;
use Illuminate\View\View;

/**
 * Activity Log Controller
 *
 * Display activity logs in admin panel
 */
class ActivityLogController extends Controller
{
    // Display activity logs
     
    public function index(): View
    {
        $logs = ActivityLog::with(['admin', 'loggable'])->latest()->paginate(20);

        return view('admin.activity_logs.index', compact('logs'));
    }
}
