<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use \App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['Premier', 'Faceit', 'Competitive', 'Casual']),
            'preference' => implode(',', fake()->randomElements(
                ['Ancient', 'Dust2', 'Inferno', 'Mirage', 'Nuke', 'Overpass', 'Train'],
                rand(1, 3)
            )),
        ];
    }
}
