<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * Tear down
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Can we can update an existing task
     *
     * @return void
     */
    public function testCanUpdateTaskTest()
    {
        $data = ['status' => 'in progress', 'description' => 'another description'];
        $response = $this->put('api/update/1', $data);
        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * Can we can delete an existing task
     *
     * @return void
     */
    public function testCanDeleteTaskTest()
    {
        $response = $this->delete('api/delete/1');
        $this->assertDatabaseMissing('tasks', ['id' => 1]);
    }

    /**
     * Can we create a new task
     *
     * @return void
     */
    public function testCanCreateTaskTest()
    {
        $data =  ['status' => 'done', 'description' => 'test desc'];
        $response = $this->post('api/store', $data);
        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * Can we get all the tasks
     *
     * @return void
     */
    public function testCanGetTasksTest()
    {
        $response = $this->get('api/index');
        $response->assertStatus(200);
    }
}
