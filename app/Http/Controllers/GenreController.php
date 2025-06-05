<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class GenreController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function show(Genre $genre)
    {
        // Загружаем фильмы, связанные с жанром
        $genre->load('films');

        return view('genre.show', compact('genre'));
    }
}
