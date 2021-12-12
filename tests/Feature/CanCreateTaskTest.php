<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CamCreateTaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanCreateTask()
    {
        $response = $this->get('/tasks/store');

        $this->assertDatabaseHas('tasks', [
            'description' => 'sally@example.com',
            'status' => 'done'
        ]);
    }
}
