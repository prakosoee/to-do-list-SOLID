<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskLabelSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('task_label')->insert([
                'task_id' => $i,
                'label_id' => rand(1, 5), // Assign label secara acak
            ]);
        }
    }
}
