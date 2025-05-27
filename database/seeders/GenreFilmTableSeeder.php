<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Film;
use Faker\Factory as Faker;

class GenreFilmTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Получаем все ID фильмов из таблицы films
        $filmIds = Film::pluck('id')->toArray();
        
        // Проверяем, что таблица films не пуста
        if (empty($filmIds)) {
            throw new \Exception('Таблица films пуста. Сначала заполните таблицу films.');
        }

        // Генерируем связи для таблицы genre_film
        $data = [];
        foreach (range(1, 100) as $index) { // Создаём, например, 100 связей
            $data[] = [
                'film_id' => $faker->randomElement($filmIds), // Случайный film_id из существующих
                'genre_id' => $faker->numberBetween(1, 30),  // Случайный genre_id от 1 до 30
                
            ];
        }

        // Вставляем данные в таблицу genre_film
        DB::table('genre_film')->insert($data);
    }
}