<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CanCreateTaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanCreateTaskTest()
    {
        $response = $this->post('/store', ['status' => 'done', 'description' => 'test desc']);
        $this->assertDatabaseHas('tasks', [
            'description' => 'test desc',
            'status' => 'done'
        ]);
    }
}
