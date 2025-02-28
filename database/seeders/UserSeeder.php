<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Elang',
            'email' => 'elangprakoso088@gmail.com',
            'password' => bcrypt('maggot.123'),
        ]);
    }
}
