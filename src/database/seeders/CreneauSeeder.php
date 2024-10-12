<?php

namespace Database\Seeders;

use App\Models\Creneau;
use Illuminate\Database\Seeder;

class CreneauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i=1; $i < 6; $i++) { 
            for($j=8; $j <= 18; $j++) {
                $data[] = [
                    'jour_semaine' => $i,
                    'heure_debut' => $j.":00",
                    'heure_fin' => ($j+1).":00",
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        Creneau::insert($data);
    }
}
