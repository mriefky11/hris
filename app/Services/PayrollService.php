<?php

namespace App\Services;

use App\Models\Payroll;
use App\Repositories\PayrollRepository;

class PayrollService
{
    public PayrollRepository $payrollRepository;

    public function __construct(PayrollRepository $payrollRepository)
    {
        $this->payrollRepository = $payrollRepository;
    }

    public function allForUser($user)
    {
        if ($user->isAdmin()) {
            return $this->payrollRepository->getAll();
        }

        if (! $user->employee) {
            return Payroll::whereRaw('1 = 0')->paginate(10);
        }

        return $this->payrollRepository->getByEmployee($user->employee->id);
    }

    public function create(array $data)
    {
        $data['net_salary'] = $this->calculateNetSalary($data);

        return $this->payrollRepository->create($data);
    }

    public function findById($id)
    {
        return $this->payrollRepository->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $payroll = $this->payrollRepository->findOrFail($id);
        $data['net_salary'] = $this->calculateNetSalary($data);

        return $this->payrollRepository->update($payroll, $data);
    }

    public function destroy($id)
    {
        $payroll = $this->payrollRepository->findOrFail($id);

        return $this->payrollRepository->destroy($payroll);
    }

    public function canAccess($user, Payroll $payroll): bool
    {
        return $user->isAdmin() || $user->employee?->id === $payroll->employee_id;
    }

    private function calculateNetSalary(array $data): float
    {
        $salary = (float) ($data['salary'] ?? 0);
        $bonuses = (float) ($data['bonuses'] ?? 0);
        $deductions = (float) ($data['deductions'] ?? 0);

        return $salary + $bonuses - $deductions;
    }
}
