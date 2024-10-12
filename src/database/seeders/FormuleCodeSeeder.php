<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormuleCode;

class FormuleCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'formule_id' => 1, // 'Code'
                'duree_validite' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'formule_id' => 2, // 'Code Illimité'
                'duree_validite' => null,
                'created_at' => now(),
                'updated_at' => now()]
            ];

        FormuleCode::insert($data);
    }
}
