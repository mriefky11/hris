<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    public EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function all()
    {
        return $this->employeeRepository->all();
    }

    public function create(array $data)
    {
        return $this->employeeRepository->create($data);
    }

    public function findById($id)
    {
        return $this->employeeRepository->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $employee = $this->employeeRepository->findOrFail($id);
        return $this->employeeRepository->update($employee, $data);
    }

    public function destroy($id)
    {
        $employee = $this->employeeRepository->findOrFail($id);
        return $this->employeeRepository->destroy($employee);
    }
}
