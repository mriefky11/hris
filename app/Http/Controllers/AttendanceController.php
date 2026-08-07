<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $attendances = $this->attendanceService->getAll();
            $todayAttendance = null;
        } else {
            $employeeId = $user->employee->id;
            $attendances = $this->attendanceService->getAllByEmployee($employeeId);
            $todayAttendance = $this->attendanceService->getToday($employeeId);
        }

        return view('attendances.index', compact('attendances', 'todayAttendance'));
    }

    public function checkIn(Request $request)
    {
        $employeeId = auth()->user()->employee->id;

        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'nullable|string',
        ]);

        try {
            $this->attendanceService->checkIn($employeeId, $data);

            return redirect()->back()->with('success', 'Check-in berhasil.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function checkOut(Request $request)
    {
        $employeeId = auth()->user()->employee->id;

        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'nullable|string',
        ]);

        try {
            $this->attendanceService->checkOut($employeeId, $data);

            return redirect()->back()->with('success', 'Check-out berhasil.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $attendance = $this->attendanceService->findById($id);
        $user = auth()->user();

        if (! $user->isAdmin() && $user->employee?->id !== $attendance->employee_id) {
            abort(403);
        }

        return view('attendances.show', compact('attendance'));
    }
}
