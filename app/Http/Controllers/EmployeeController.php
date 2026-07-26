<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public EmployeeService $employeeService;
    public RoleService $roleService;
    public DepartmentService $departmentService;

    public function __construct(
        EmployeeService $employeeService,
        RoleService $roleService,
        DepartmentService $departmentService
    ) {
        $this->employeeService = $employeeService;
        $this->roleService = $roleService;
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $employees = $this->employeeService->all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $roles = $this->roleService->all();
        $departments = $this->departmentService->all();
        return view('employees.create', compact('roles', 'departments'));
    }

    public function store(StoreRequest $request)
    {
        $this->employeeService->create($request->validated());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        $employee = $this->employeeService->findById($id);
        return view('employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = $this->employeeService->findById($id);
        $roles = $this->roleService->all();
        $departments = $this->departmentService->all();
        return view('employees.create', compact('employee', 'roles', 'departments'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->employeeService->update($request->validated(), $id);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $this->employeeService->destroy($id);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
