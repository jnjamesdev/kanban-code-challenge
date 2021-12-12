<?php

namespace App\UseCases;

use App\DTO\TaskDto;
use App\Repositories\TaskRepository;


class StoreTaskUseCase
{
    private TaskRepository $taskRepo;

    public function __construct()
    {
        $this->taskRepo = app(TaskRepository::class);
    }



    public function handle(TaskDTO $taskDto)
    {
        logger('333333');
        $this->taskRepo->store($taskDto);
    }
}