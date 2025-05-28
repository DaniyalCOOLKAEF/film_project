<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class FilmsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $genres = Genre::all();

        // Создаём 30 фильмов
        Film::factory(30)->create()->each(function ($film) use ($genres) {
            // Случайно выбираем 1–3 жанра и прикрепляем их к фильму
            $film->genres()->attach(
                $genres->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}