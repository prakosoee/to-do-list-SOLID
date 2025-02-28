<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $faker = Faker::create('id_ID');
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
        ];
    }
}
