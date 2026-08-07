<?php

namespace App\Repositories;

use App\Models\Payroll;

class PayrollRepository
{
    public function getAll()
    {
        return Payroll::with('employee')
            ->orderBy('pay_date', 'desc')
            ->paginate(10);
    }

    public function getByEmployee($employeeId)
    {
        return Payroll::with('employee')
            ->where('employee_id', $employeeId)
            ->orderBy('pay_date', 'desc')
            ->paginate(10);
    }

    public function findOrFail($id)
    {
        return Payroll::with('employee')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Payroll::create($data);
    }

    public function update(Payroll $payroll, array $data)
    {
        $payroll->update($data);

        return $payroll->fresh('employee');
    }

    public function destroy(Payroll $payroll)
    {
        return $payroll->delete();
    }
}
