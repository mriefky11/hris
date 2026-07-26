<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\EmployeeService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;

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

    public function show($id)
    {
        $task = $this->taskService->findById($id);
        $employess = $this->employeeService->all();
        return view('tasks.show', compact('task', 'employess'));
    }

    public function create()
    {
        $employees = $this->employeeService->all();
        return view('tasks.create', compact('employees'));
    }

    public function store(StoreRequest $request)
    {
        $this->taskService->create($request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = $this->taskService->findById($id);
        $employees = $this->employeeService->all();

        return view('tasks.create', compact('task', 'employees'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->taskService->update($request->validated(), $id);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $this->taskService->destroy($id);

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:todo,pending,in-progress,done',
        ]);

        $this->taskService->updateStatus($id, $request->status);

        return redirect()->back()->with('success', 'Status updated');
    }
}
