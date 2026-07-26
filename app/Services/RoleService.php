<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    public RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function all()
    {
        return $this->roleRepository->all();
    }

    public function findById($id)
    {
        return $this->roleRepository->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->roleRepository->create($data);
    }

    public function update(array $data, $id)
    {
        $role = $this->roleRepository->findOrFail($id);
        return $this->roleRepository->update($role, $data);
    }

    public function destroy($id)
    {
        $role = $this->roleRepository->findOrFail($id);
        return $this->roleRepository->delete($role);
    }
}
