<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Faker\Factory as Faker;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $faker = Faker::create('id_ID');
        return [
            'user_id' => User::factory(),
            'category_id' => Category::query()->inRandomOrder()->first()?->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
