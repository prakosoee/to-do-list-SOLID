<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Work', 'Personal', 'Study', 'Health', 'Finance'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'user_id' => 1, // Assign ke user pertama
            ]);
        }
    }
}
