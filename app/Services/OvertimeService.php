<?php

namespace App\Services;

use App\Models\Overtime;
use App\Repositories\OvertimeRepository;

class OvertimeService
{
    public OvertimeRepository $overtimeRepository;

    public function __construct(OvertimeRepository $overtimeRepository)
    {
        $this->overtimeRepository = $overtimeRepository;
    }

    public function allForUser($user)
    {
        if ($user->isAdmin()) {
            return $this->overtimeRepository->getAll();
        }

        if (! $user->employee) {
            return Overtime::whereRaw('1 = 0')->paginate(10);
        }

        return $this->overtimeRepository->getByEmployee($user->employee->id);
    }

    public function create(array $data, $employeeId)
    {
        $data['employee_id'] = $employeeId;
        $data['status'] = 'pending';

        return $this->overtimeRepository->create($data);
    }

    public function findById($id)
    {
        return $this->overtimeRepository->findOrFail($id);
    }

    public function updateStatus(Overtime $overtime, string $status, $approverId)
    {
        return $this->overtimeRepository->update($overtime, [
            'status' => $status,
            'approved_by' => $approverId,
        ]);
    }

    public function destroy($id)
    {
        $overtime = $this->overtimeRepository->findOrFail($id);

        return $this->overtimeRepository->destroy($overtime);
    }

    public function canAccess($user, Overtime $overtime): bool
    {
        return $user->isAdmin() || $user->employee?->id === $overtime->employee_id;
    }
}
