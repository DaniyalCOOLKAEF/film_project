<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genres = Genre::all();
        $usedTitles = Film::pluck('title')->toArray();

        $count = 0;
        while ($count < 6) {
            $filmData = Film::factory()->make()->toArray();

            if (in_array($filmData['title'], $usedTitles)) {
                continue; // название уже существует — пробуем снова
            }

            $film = Film::create($filmData);
            $film->genres()->attach($genres->random(rand(1, 3))->pluck('id')->toArray());

            $usedTitles[] = $filmData['title'];
            $count++;
        }
    }
}
