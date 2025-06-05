<?php

namespace Database\Factories;

use App\Models\Film;
use App\Providers\Faker\FilmTitleProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FilmTitleProvider($this->faker));

        return [
            'title' => $this->faker->filmTitle(),
            'published' => false, // По умолчанию не опубликован
            'link' => 'images/noposter.png', // Путь к дефолтному изображению

        ];
    }
}
