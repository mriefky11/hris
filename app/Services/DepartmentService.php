<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    public DepartmentRepository $departmentRepository;


    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function all()
    {
        return $this->departmentRepository->all();
    }
}
