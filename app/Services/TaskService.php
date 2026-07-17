<?php

namespace App\Services;

use App\Http\Requests\Task\StoreRequest;
use App\Repositories\TaskRepository;

class TaskService
{
    public TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function all()
    {
        return $this->taskRepository->all();
    }

    public function create(StoreRequest $request)
    {
        $data = $request->validated();

        return $this->taskRepository->create($data);
    }
}
