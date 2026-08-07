<?php

namespace App\Services;

use App\Models\Leave;
use App\Repositories\LeaveRepository;
{
    public LeaveRepository $leaveRepository;

    public function __construct(LeaveRepository $leaveRepository)
    {
        $this->leaveRepository = $leaveRepository;
    }

    public function allForUser($user)
    {
        if ($user->isAdmin()) {
            return $this->leaveRepository->getAll();
        }

        if (! $user->employee) {
            return Leave::whereRaw('1 = 0')->paginate(10);
        }

        return $this->leaveRepository->getByEmployee($user->employee->id);
    }

    public function create(array $data, $employeeId)
    {
        $data['employee_id'] = $employeeId;
        $data['status'] = 'pending';

        return $this->leaveRepository->create($data);
    }

    public function findById($id)
    {
        return $this->leaveRepository->findOrFail($id);
    }

    public function updateStatus(Leave $leave, string $status, $approverId)
    {
        return $this->leaveRepository->update($leave, [
            'status' => $status,
            'approved_by' => $approverId,
        ]);
    }

    public function destroy($id)
    {
        $leave = $this->leaveRepository->findOrFail($id);

        return $this->leaveRepository->destroy($leave);
    }

    public function canAccess($user, Leave $leave): bool
    {
        return $user->isAdmin() || $user->employee?->id === $leave->employee_id;
    }
}
