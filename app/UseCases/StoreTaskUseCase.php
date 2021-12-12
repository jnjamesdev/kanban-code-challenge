<?php

namespace App\UseCases;

use App\DTO\TaskDto;
use App\Repositories\TaskRepositories;


class StoreUserUseCase
{
    private TaskRepository $taskRepo;

    public function __construct()
    {
        $this->taskRepo = app(TaskRepository::class);
    }



    public function handle(TaskDTO $taskDto)
    {

    }
}