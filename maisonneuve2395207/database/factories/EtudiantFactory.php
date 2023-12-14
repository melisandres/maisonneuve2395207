<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ville;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $villeIds = Ville::pluck('id')->toArray();
        return [
            //
            'nom' => fake()->name(),
            'adresse' => fake()->streetAddress(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'dob' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'ville_id' => fake()->randomElement($villeIds),
        ];
    }
}
