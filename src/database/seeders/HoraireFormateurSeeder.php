<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Creneau;
use Illuminate\Database\Seeder;

class HoraireFormateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $number = 200): void
    {
        $creneau_count = Creneau::whereNotBetween('heure_debut', ['12:00', '13:00'])->count();

        for ($i=0; $i < $number; $i++) { 
            $user = User::all()->random();
            $user_creneaux = $user->creneaux;
            $user_creneaux_count = $user->creneaux->count();
            
            // On vérifie que le formateur n'a pas déjà tous les créneaux
            if($user_creneaux_count >= $creneau_count) {
                continue;
            }
            
            $creneau = Creneau::whereNotBetween('heure_debut', ['12:00', '13:00'])->whereNotIn('id', $user_creneaux->pluck("id"))->inRandomOrder()->first();
            $user->creneaux()->attach($creneau);
        }
    }
}
