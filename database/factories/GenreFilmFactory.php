<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Providers\Faker\FilmTitleProvider;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Film>
 */
class GenreFilmFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'genre_id' => $this->faker->numberBetween(1,30),
            'film_id' => $this->faker->numberBetween(1,100)
        ];
    }
}
