<?php

namespace App\Repositories;

use App\DTO\TaskDto;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    /**
     * store a task
     *
     * @param TaskDto $dto
     * @return void
     */
    public function store(TaskDto $dto): void
    {
        $task = new Task();
        $task->description = $dto->getDescription();
        $task->status = $dto->getStatus();
        $task->order = $dto->getOrder();
        $task->save();
    }

    /**
     * update a task
     *
     * @param TaskDto $dto
     * @return void
     */
    public function update(TaskDto $dto): void
    {
        $task = $this->getById($dto->getId());

        if ($dto->getStatus() !== null) {
            $task->status = $dto->getStatus();
        }

        if ($dto->getDescription() !== null) {
            $task->description = $dto->getDescription();
        }

        if ($dto->getOrder() !== null) {
            $task->order = $dto->getOrder();
        }

        $task->save();
    }

    /**
     * delete a task
     *
     * @param TaskDto $dto
     * @return void
     */
    public function delete(TaskDto $dto): void
    {
        $task = $this->getById($dto->getId());
        $task->delete();
    }

    /**
     * Get task by ID
     *
     * @param int $id
     * @return Task
     */
    public function getById(int $id): Task
    {
        return Task::find($id);
    }

    /**
     * Get all tasks
     *
     * @return Collection
     */
    public function getAllGroupedByStatus(): Collection
    {
        return Task::all();
    }
}