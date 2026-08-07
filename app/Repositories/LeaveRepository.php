<?php

namespace App\Repositories;

use App\Models\Leave;

class LeaveRepository
{
    public function getAll()
    {
        return Leave::with(['employee', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getByEmployee($employeeId)
    {
        return Leave::with(['employee', 'approver'])
            ->where('employee_id', $employeeId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function findOrFail($id)
    {
        return Leave::with(['employee', 'approver'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Leave::create($data);
    }

    public function update(Leave $leave, array $data)
    {
        $leave->update($data);

        return $leave->fresh(['employee', 'approver']);
    }

    public function destroy(Leave $leave)
    {
        return $leave->delete();
    }
}
