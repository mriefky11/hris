<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    public function all()
    {
        return Role::all();
    }

    public function findOrFail($id)
    {
        return Role::findOrFail($id);
    }

    public function create(array $data)
    {
        return Role::create($data);
    }

    public function update(Role $role, array $data)
    {
        $role->update($data);
        return $role;
    }

    public function delete(Role $role)
    {
        $role->delete();
    }
}
