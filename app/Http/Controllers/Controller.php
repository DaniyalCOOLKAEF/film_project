<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function create(){
        Genre::create([
            'name' => 'Action', 
        ]);
    }
    public function create2(){
        Film::create([
            'title' => 'Adventure',
            
            'link' => 'https://www.youtube.com/watch?v=1'
        ]);
    }



    public function test()
    {
        // Получим первый жанр и выведем его фильмы
        $genre = Genre::first();
        echo "Фильмы жанра: " . $genre->name . "\n";

        foreach ($genre->films as $film) {
            echo "- " . $film->title . "\n";
        }

        echo "\n";

        // Получим первый фильм и выведем его жанры
        $film = Film::first();
        echo "Жанры фильма: " . $film->title . "\n";

        foreach ($film->genres as $genre) {
            echo "- " . $genre->name . "\n";
        }

        // Можно вернуть JSON, если хочется красиво в браузере:
        return response()->json([
            'genre' => $genre->name,
            'films' => $genre->films->pluck('title'),
            'film' => $film->title,
            'genres' => $film->genres->pluck('name'),
        ]);
    }
}

    
