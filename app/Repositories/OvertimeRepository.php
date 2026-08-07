<?php

namespace App\Repositories;

use App\Models\Overtime;

class OvertimeRepository
{
    public function getAll()
    {
        return Overtime::with(['employee', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getByEmployee($employeeId)
    {
        return Overtime::with(['employee', 'approver'])
            ->where('employee_id', $employeeId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function findOrFail($id)
    {
        return Overtime::with(['employee', 'approver'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Overtime::create($data);
    }

    public function update(Overtime $overtime, array $data)
    {
        $overtime->update($data);

        return $overtime->fresh(['employee', 'approver']);
    }

    public function destroy(Overtime $overtime)
    {
        return $overtime->delete();
    }
}
