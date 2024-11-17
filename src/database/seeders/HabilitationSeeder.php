<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TypePermis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class HabilitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $number = 5): void
    {
        $permis_count = TypePermis::all()->count();

        for ($i=0; $i < $number; $i++) {
            $user = User::role('formateur')->inRandomOrder()->first();
            $user_permis = $user->typePermis;
            $user_permis_count = $user_permis->count();
            
            // On vérifie que le formateur n'a pas déjà toutes les habilitations
            if($user_permis_count >= $permis_count) {
                continue;
            }

            $permis = TypePermis::whereNotIn('id', $user_permis->pluck("id"))->inRandomOrder()->first();
            $user->typePermis()->withTimestamps()->attach($permis);
        }
    }
}
