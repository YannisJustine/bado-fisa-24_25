<?php

namespace Database\Seeders;

use App\Models\TypePermis;
use App\Enums\TypePermisEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePermisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'libelle' => TypePermisEnum::PERMIS_A,
                'prix_unitaire' => 50,
                'age_minimum_requis' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'libelle' => TypePermisEnum::PERMIS_B,
                'prix_unitaire' => 70.0,
                'age_minimum_requis' => 18,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'libelle' => TypePermisEnum::PERMIS_C,
                'prix_unitaire' => 80,
                'age_minimum_requis' => 21,
                'created_at' => now(),
                'updated_at' => now()]
            ];

        TypePermis::insert($data);
    }
}
