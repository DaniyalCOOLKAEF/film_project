<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Providers\Faker\FilmGenreProvider;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Film>
 */
class GenreFactory extends Factory
{
    protected $model = Genre::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FilmGenreProvider($this->faker));
        return [
            'name' => $this->faker->filmGenres(),
            
        ];
    }
}
