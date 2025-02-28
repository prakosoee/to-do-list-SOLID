<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class LabelFactory extends Factory
{
    protected $model = Label::class;

    public function definition(): array
    {
        $faker = Faker::create('id_ID');
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
        ];
    }
}
