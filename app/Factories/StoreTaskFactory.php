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
    public function fromRequest(Request $request = null, int $id = null): TaskDto
    {
        $dto = new TaskDto();

        if ($id) {
            $dto->setId($id);
        }

        if ($request) {
            $dto->setDescription($request->description);
            $dto->setStatus($request->status);
            $dto->setOrder((int) $request->order ?? null);

        }

        return $dto;
    }
}