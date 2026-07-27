<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        $employeeId = auth()->user()->employee->id;

        $attendances = $this->attendanceService->getAllByEmployee($employeeId);
        $todayAttendance = $this->attendanceService->getToday($employeeId);

        return view('attendances.index', compact('attendances', 'todayAttendance'));
    }

    public function checkIn(Request $request)
    {
        $employeeId = auth()->user()->employee->id;

        $data = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'required|string',
        ]);

        $this->attendanceService->checkIn($employeeId, $data);

        return redirect()->back()->with('success', 'Check-in success');
    }

    public function checkOut(Request $request)
    {
        $employeeId = auth()->user()->employee->id;

        $data = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'photo' => 'required|string',
        ]);

        $this->attendanceService->checkOut($employeeId, $data);

        return redirect()->back()->with('success', 'Check-out success');
    }

    public function show($id)
    {
        $attendance = $this->attendanceService->findById($id);

        return view('attendances.show', compact('attendance'));
    }
}
