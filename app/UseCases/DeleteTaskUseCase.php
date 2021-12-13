<?php

namespace App\UseCases;

use App\DTO\TaskDto;
use App\Repositories\TaskRepository;


class DeleteTaskUseCase
{
    private TaskRepository $taskRepo;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->taskRepo = app(TaskRepository::class);
    }

    /**
     * Handle the use case
     *
     * @param TaskDTO $taskDto
     * @return void
     */
    public function handle(TaskDTO $taskDto): void
    {
        $this->taskRepo->delete($taskDto);
    }
}