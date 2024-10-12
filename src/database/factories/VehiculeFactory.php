<?php

namespace Database\Factories;

use App\Models\TypePermis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicule>
 */
class VehiculeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            "marque" => $this->faker->randomElement(['Peugeot', 'Renault', 'Citroën', 'BMW', 'Mercedes', 'Audi', 'Volkswagen', 'Fiat', 'Ford', 'Opel', 'Toyota', 'Nissan', 'Hyundai', 'Kia', 'Dacia', 'Seat', 'Skoda', 'Mini', 'Land Rover', 'Jeep', 'Volvo', 'Mazda', 'Honda', 'Mitsubishi', 'Suzuki', 'Alfa Romeo', 'Lancia', 'Porsche', 'Jaguar', 'Lexus', 'Smart', 'Subaru', 'Tesla', 'DS', 'Abarth', 'Infiniti', 'SsangYong', 'Maserati', 'Chevrolet', 'Daihatsu', 'Chrysler', 'Dodge', 'Hummer', 'Saab', 'Autre']),
            "plaque_imm" => $this->faker->regexify('[A-Z]{2}-[0-9]{3}-[A-Z]{2}'),
            "date_achat" => $this->faker->dateTimeBetween('-1 year', 'now'),
            "puissance" => $this->faker->numberBetween(5, 20),
            "type_permis_id" => TypePermis::all()->random(),
        ];
    }
}
