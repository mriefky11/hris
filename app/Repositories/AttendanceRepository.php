<?php

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository
{
    public function getAll()
    {
        return Attendance::with('employee')
            ->orderBy('date', 'desc')
            ->paginate(10);
    }

    public function getByEmployee($employeeId)
    {
        return Attendance::with('employee')
            ->where('employee_id', $employeeId)
            ->orderBy('date', 'desc')
            ->paginate(10);
    }

    public function find($id)
    {
        return Attendance::with('employee')->findOrFail($id);
    }

    public function findToday($employeeId)
    {
        return Attendance::where('employee_id', $employeeId)
            ->whereDate('date', today())
            ->first();
    }

    public function create(array $data)
    {
        return Attendance::create($data);
    }

    public function update($id, array $data)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($data);

        return $attendance;
    }
}
