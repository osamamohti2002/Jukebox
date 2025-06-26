<?php

namespace Database\Factories;

use App\Models\Genre;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'song' => fake()->word(),
            'artiest' => fake()->name(),
            'description' => fake()->sentence(10, true),
            'song_image' => 'foto1',
            'genre' => Genre::inRandomOrder()->first()->genre,
            'duration' => fake()->numberBetween(60, 600)

        ];
    }
}
