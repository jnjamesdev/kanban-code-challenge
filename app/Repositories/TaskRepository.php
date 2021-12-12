<?php

namespace App\Repositories;

use App\DTO\TaskDto;
use App\Models\Task;

class TaskRepository
{
    /**
     * store a task
     *
     * @param TaskDto $dto
     * @return void
     */
    public function store(TaskDto $dto)
    {

        logger('44444');
        $task = new Task();
        $task->description = $dto->getDescription();
        $task->status = $dto->getStatus();
        $task->save();
        logger('55555');


    }
}