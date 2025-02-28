<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Task::create([
                'title' => 'Task ' . $i,
                'description' => 'This is task number ' . $i,
                'status' => ['pending', 'in_progress', 'completed'][rand(0, 2)],
                'user_id' => 1, // Assign ke user pertama
                'category_id' => rand(1, 5), // Random kategori
                'due_date' => now()->addDays(rand(1, 10)),
            ]);
        }
    }
}
