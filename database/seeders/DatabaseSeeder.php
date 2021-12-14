<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            ['id' => '1', 'status' => 'done', 'description' => 'test desc', 'order' => 1],
            ['id' => '2', 'status' => 'in progress', 'description' => 'test desc', 'order' => 2],
            ['id' => '3', 'status' => 'todo', 'description' => 'test desc', 'order' => 3],
            ['id' => '4', 'status' => 'done', 'description' => 'test desc', 'order' => 2],
            ['id' => '5', 'status' => 'done', 'description' => 'test desc', 'order' => 3],

        ]);
    }
}
