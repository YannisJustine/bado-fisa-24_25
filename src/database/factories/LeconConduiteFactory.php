<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Lecon;
use App\Models\Candidat;
use App\Models\Vehicule;
use App\Models\FormuleConduite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeconConduite>
 */
class LeconConduiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Définissez d'autres attributs du modèle LeconConduite si nécessaire
        ];
    }

    /**
     * Indicate that the leconConduite should have associated lecon.
     *
     * @return $this
     */
    public function hasLecon($count = 1)
    {
        return $this->has(Lecon::factory()->count($count));
    }

    /**
     * Indicate that the leconConduite should have associated user.
     *
     * @return $this
     */
    public function hasUser($count = 1)
    {
        return $this->has(User::factory()->count($count));
    }

    /**
     * Indicate that the leconConduite should have associated candidat.
     *
     * @return $this
     */
    public function hasCandidat($count = 1)
    {
        return $this->has(Candidat::factory()->count($count));
    }

    /**
     * Indicate that the leconConduite should have associated vehicule.
     *
     * @return $this
     */
    public function hasVehicule($count = 1)
    {
        return $this->has(Vehicule::factory()->count($count));
    }

    /**
     * Indicate that the leconConduite should have associated formuleConduite.
     *
     * @return $this
     */
    public function hasFormuleConduite($count = 1)
    {
        return $this->has(FormuleConduite::factory()->count($count));
    }
}