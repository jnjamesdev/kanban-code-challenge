<?php

namespace App\UseCases;

use App\DTO\TaskDto;
use App\Repositories\TaskRepository;


class DeleteTaskUseCase
{
    private TaskRepository $taskRepo;

    public function __construct()
    {
        $this->taskRepo = app(TaskRepository::class);
    }



    public function handle(TaskDTO $taskDto)
    {
        $this->taskRepo->delete($taskDto);
    }
}