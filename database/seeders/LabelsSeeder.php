<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelsSeeder extends Seeder
{
    public function run()
    {
        $labels = ['Urgent', 'Low Priority', 'Medium Priority', 'Important', 'Optional'];

        foreach ($labels as $label) {
            Label::create([
                'name' => $label,
                'user_id' => 1, // Pastikan user dengan ID 1 ada di database
            ]);
        }
    }

}
