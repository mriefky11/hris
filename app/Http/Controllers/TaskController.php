<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\EmployeeService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Requests\Task\StoreRequest;

class TaskController extends Controller
{
    public TaskService $taskService;
    public EmployeeService $employeeService;

    public function __construct(TaskService $taskService, EmployeeService $employeeService)
    {
        $this->taskService = $taskService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $tasks = $this->taskService->all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = $this->employeeService->all();
        return view('tasks.create', compact('employees'));
    }

    public function store(StoreRequest $request)
    {
        $this->taskService->create($request);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
}
