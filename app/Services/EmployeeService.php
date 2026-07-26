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
}
