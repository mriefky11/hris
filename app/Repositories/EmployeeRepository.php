<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function all()
    {
        return Employee::all();
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function findOrFail($id)
    {
        return Employee::findOrFail($id);
    }

    public function update(Employee $employee, array $data)
    {
        $employee->update($data);
        return $employee;
    }

    public function destroy(Employee $employee)
    {
        return $employee->delete();
    }
}
