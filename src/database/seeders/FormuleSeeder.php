<?php

namespace Database\Seeders;
use App\Models\Formule;
use App\Enums\FormuleEnum;
use Illuminate\Database\Seeder;

class FormuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'libelle' => FormuleEnum::CODE,
                'prix' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'libelle' => FormuleEnum::CODE_ILLIMITE,
                'prix' => 80,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'libelle' => FormuleEnum::CONDUITE_ACCOMPAGNEE_B,
                'prix' => 90,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'libelle' => FormuleEnum::CONDUITE_NORMALE_B,
                'prix' => 80,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'libelle' => FormuleEnum::MOTO,
                'prix' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'libelle' => FormuleEnum::POIDS_LOURD,
                'prix' => 200,
                'created_at' => now(),
                'updated_at' => now()]
            ];

        Formule::insert($data);
    }
}
