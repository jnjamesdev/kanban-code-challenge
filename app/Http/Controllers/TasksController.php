<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\UseCases\StoreUserUseCase;
use App\Factories\StoreTaskFactory;

class TasksController extends Controller
{
    private StoreTaskUseCase $storeTaskUseCase;
    private StoreTaskFactory $storeTaskFactory;

    public function __construct()
    {
        $this->storeTaskUseCase = app(StoreTaskUseCase::class);
        $this->storeTaskFactory = app(StoreTaskFactory::class);

    }
    /**
     * Create a task
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $dto = $this->storeTaskFactory($request);

        $this->storeTaskUseCase($dto);
    }
}