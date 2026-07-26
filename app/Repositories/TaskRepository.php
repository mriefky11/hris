<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function all()
    {
        return Task::all();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function findOrFail($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        return $task->delete();
    }

    public function updateStatus($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task;
    }
}
