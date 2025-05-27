<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class FilmController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $films = Film::with('genres')->get(); // Загружаем фильмы с их жанрами
        $genres = Genre::all();
        return view('film.index', compact('films', 'genres'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('film.create', compact('genres'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'genre_id' => 'array', 
            'genre_id.*' => 'exists:genres,id', // Проверка, что жанры существуют
        ]);

        $film = Film::create(['title' => $data['title']]);
        if (!empty($data['genre_id'])) {
            $film->genres()->attach($data['genre_id']); // Привязываем жанры
        }

        return redirect()->route('film.index');
    }

    public function show(Film $film)
    {
        $film->load('genres'); // Загружаем жанры для конкретного фильма
        return view('film.show', compact('film'));
    }

    public function edit(Film $film)
    {
        $genres = Genre::all(); // Для формы редактирования
        return view('film.edit', compact('film', 'genres'));
    }

    public function update(Film $film)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'genre_id' => 'array',
            'genre_id.*' => 'exists:genres,id',
        ]);

        $film->update(['title' => $data['title']]);
        if (!empty($data['genre_id'])) {
            $film->genres()->sync($data['genre_id']); // Синхронизируем жанры
        } else {
            $film->genres()->detach(); // Удаляем все жанры, если не выбраны
        }

        return redirect()->route('film.show', $film->id);
    }
}