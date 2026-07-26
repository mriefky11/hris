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

    public function findById($id)
    {
        return $this->departmentRepository->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->departmentRepository->create($data);
    }

    public function update(array $data, $id)
    {
        $department = $this->departmentRepository->findOrFail($id);
        return $this->departmentRepository->update($department, $data);
    }

    public function destroy($id)
    {
        $department = $this->departmentRepository->findOrFail($id);
        return $this->departmentRepository->delete($department);
    }
}
