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

    public function findById($id)
    {
        return $this->taskRepository->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function update(array $data, $id)
    {
        $task = $this->taskRepository->findOrFail($id);

        return $this->taskRepository->update($task, $data);
    }

    public function destroy($id)
    {
        $task = $this->taskRepository->findOrFail($id);

        return $this->taskRepository->delete($task);
    }

    public function updateStatus($id, $status)
    {
        $task = $this->taskRepository->findOrFail($id);

        return $this->taskRepository->updateStatus($id, [
            'status' => $status
        ]);
    }
}
