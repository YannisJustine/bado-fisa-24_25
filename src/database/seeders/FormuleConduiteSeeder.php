<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormuleConduite;

class FormuleConduiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'formule_id' => 3, // 'Conduite accompagnée B'
                'type_permis_id' => 2, // 'Permis B'
                'age_minimum' => 15,
                'age_maximum' => 17,
                'nb_heures_conduite' => 20,
                'nb_heures_pedagogique' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'formule_id' => 4, // 'Conduite normale B'
                'type_permis_id' => 2, // 'Permis B'
                'age_minimum' => null,
                'age_maximum' => null,
                'nb_heures_conduite' => 20,
                'nb_heures_pedagogique' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'formule_id' => 5, // 'Moto'
                'type_permis_id' => 1, // 'Permis A'
                'age_minimum' => null,
                'age_maximum' => null,
                'nb_heures_conduite' => 24,
                'nb_heures_pedagogique' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'formule_id' => 6, // 'Poids-Lourd'
                'type_permis_id' => 3, // 'Permis C'
                'age_minimum' => null,
                'age_maximum' => null,
                'nb_heures_conduite' => 70,
                'nb_heures_pedagogique' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        FormuleConduite::insert($data);

    }
}
