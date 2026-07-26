<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->all();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(StoreRequest $request)
    {
        $this->roleService->create($request->validated());
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = $this->roleService->findById($id);
        return view('roles.create', compact('role'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->roleService->update($request->validated(), $id);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $this->roleService->destroy($id);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
