<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Overtime;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'employees' => Employee::count(),
            'tasks' => Task::count(),
            'attendances_today' => Attendance::whereDate('date', today())->count(),
            'pending_leaves' => Leave::where('status', 'pending')->count(),
            'pending_overtimes' => Overtime::where('status', 'pending')->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}
