<?php

namespace Database\Seeders;

use App\Enums\StatutEnum;
use App\Models\Statut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'id' => StatutEnum::ATTENTE,
                'statut' => 'En attente',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => StatutEnum::IMPOSSIBLE,
                'statut' => 'Impossible',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => StatutEnum::REFUSE,
                'statut' => 'Refusé',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => StatutEnum::PLANIFIE,
                'statut' => 'Planifié',
                'created_at' => now(),
                'updated_at' => now()],
            ];

        Statut::insert($data);
    }
}
