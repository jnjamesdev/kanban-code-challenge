<?php

namespace App\DTO;

class TaskDto
{
    private ?int $id;
    private ?string $description;
    private ?string $status;

    /**
     *  Get ID
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return TaskDto
     */
    public function setId(int $id): TaskDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     *  Get Description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set Description
     *
     * @param null|string $description
     * @return TaskDto
     */
    public function setDescription(?string $description): TaskDto
    {
        $this->description = $description;
        return $this;
    }

    /**
     *  Get Status
     *
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param null|string $status
     * @return TaskDto
     */
    public function setStatus(?string $status): TaskDto
    {
        $this->status = $status;
        return $this;
    }
}