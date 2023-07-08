<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TodoList;

class TodoListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TodoList::truncate();

        TodoList::create([
            'name' => 'Work tasks till and of July',
            'created_by_id' => 1,
        ]);

        TodoList::create([
            'name' => 'Life goals',
            'created_by_id' => 2,
        ]);

        TodoList::create([
            'name' => 'Things to do tomorrow',
            'created_by_id' => 2,
        ]);

        TodoList::create([
            'name' => 'Things I dream about',
            'created_by_id' => 3,
        ]);

        TodoList::create([
            'name' => 'Important tasks',
            'created_by_id' => 3,
        ]);
    }
}
