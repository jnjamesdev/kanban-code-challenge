<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\UseCases\StoreTaskUseCase;
use App\UseCases\UpdateTaskUseCase;
use App\UseCases\DeleteTaskUseCase;
use App\Factories\StoreTaskFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;


class TasksController extends Controller
{
    private StoreTaskUseCase $storeTaskUseCase;
    private StoreTaskFactory $storeTaskFactory;
    private UpdateTaskUseCase $updateTaskUseCase;
    private DeleteTaskUseCase $deleteTaskUseCase;
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->storeTaskUseCase = app(StoreTaskUseCase::class);
        $this->storeTaskFactory = app(StoreTaskFactory::class);
        $this->updateTaskUseCase = app(UpdateTaskUseCase::class);
        $this->deleteTaskUseCase = app(DeleteTaskUseCase::class);

    }

    /**
     * Create a task
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        try {
            $dto = $this->storeTaskFactory->fromRequest($request);
            $this->storeTaskUseCase->handle($dto);
            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json(500);
        }
    }

    /**
     * Update a task
     *
     * @param int $id
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function update(int $id, StoreTaskRequest $request): JsonResponse
    {
        try {
            $dto = $this->storeTaskFactory->fromRequest($request, $id);
            $this->updateTaskUseCase->handle($dto);
            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json(500);
        }
    }

    /**
     * Delete a task
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $dto = $this->storeTaskFactory->fromRequest(null, $id);
            $this->deleteTaskUseCase->handle($dto);
            return response()->json(200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(500);
        }
    }
}