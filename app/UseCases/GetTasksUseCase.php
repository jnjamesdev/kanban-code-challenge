<?php

namespace App\UseCases;

use App\DTO\TaskDto;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class GetTasksUseCase
{
    private TaskRepository $taskRepo;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->taskRepo = app(TaskRepository::class);
    }



    /**
     * Handle use case
     *
     * @return Collection
     */
    public function handle(): Collection
    {
        return $this->taskRepo->getAllGroupedByStatus();
    }
}