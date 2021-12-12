<?php

namespace App\Factories;

use Illuminate\Http\Request;
use App\DTO\TaskDto;

class StoreTaskFactory
{
    /**
     * From Request
     *
     * @param Request $request
     * @return TaskDto
     */
    public function fromRequest(Request $request): TaskDto
    {
        $dto = new TaskDto();
        $dto->setDescription($request->description);
        $dto->setStatus($request->status);
        return $dto;
    }
}