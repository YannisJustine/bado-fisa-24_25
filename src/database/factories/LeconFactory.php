<?php

namespace Database\Factories;

use DateTime;
use DateInterval;
use App\Models\Lecon;
use App\Models\Statut;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecon>
 */
class LeconFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $heureDebut = $this->faker->numberBetween(8, 16);
        $heureDebut = str_pad($heureDebut, 2, '0', STR_PAD_LEFT) . ':00:00';
        //TODO faire car yannis a modifié
        return [
            'statut_id' =>  Statut::all()->random(),
            'date_reservation' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'heure_debut' => $heureDebut,
            'heure_fin' => $this->faker->dateTimeInInterval($heureDebut, '+1 hour')->format('H:i:s'),
        ];
    }
}
