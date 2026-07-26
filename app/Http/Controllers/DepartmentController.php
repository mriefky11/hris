<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\StoreRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $departments = $this->departmentService->all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(StoreRequest $request)
    {
        $this->departmentService->create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        $department = $this->departmentService->findById($id);
        return view('departments.create', compact('department'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->departmentService->update($request->validated(), $id);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $this->departmentService->destroy($id);
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
