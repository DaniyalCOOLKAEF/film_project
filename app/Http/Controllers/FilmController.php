<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class FilmController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $films = Film::with('genres')->paginate(10);
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
            'title' => 'required|string|max:255',
            'genre_id' => 'nullable|array',
            'genre_id.*' => 'exists:genres,id',
            'link' => 'nullable|file|image|max:2048', // Изображение до 2 МБ
        ]);

        // Обработка изображения
        $linkPath = null;
        if (isset($data['link'])) {
            $linkPath = $data['link']->store('posters', 'public');
        }

        // Создание фильма
        $film = Film::create([
            'title' => $data['title'],
            'published' => false, // По умолчанию не опубликован
            'link' => $linkPath,
        ]);

        // Привязка жанров
        if (!empty($data['genre_id'])) {
            $film->genres()->attach($data['genre_id']);
        }

        return redirect()->route('film.index')->with('success', 'Film created successfully.');
    }

    public function show(Film $film)
    {
        $film->load('genres');
        return view('film.show', compact('film'));
    }

    public function show1(Genre $genre)
    {
        // Загружаем фильмы, связанные с жанром
        $genre->load('films');
        return view('film.show1', compact('genre'));
    }
    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('film.edit', compact('film', 'genres'));
    }

    public function update(Film $film)
    {
        $data = request()->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'nullable|array',
            'genre_id.*' => 'exists:genres,id',
            'link' => 'nullable|file|image|max:2048',
        ]);

        // Обработка изображения
        $updateData = ['title' => $data['title']];
        if (isset($data['link'])) {
            // Удаляем старое изображение, если оно не дефолтное
            if ($film->link && $film->link !== 'images/default-poster.jpg') {
                Storage::disk('public')->delete($film->link);
            }
            $updateData['link'] = $data['link']->store('posters', 'public');
        }

        $film->update($updateData);

        // Синхронизация жанров
        if (!empty($data['genre_id'])) {
            $film->genres()->sync($data['genre_id']);
        } else {
            $film->genres()->detach();
        }

        return redirect()->route('film.show', $film->id)->with('success', 'Film updated successfully.');
    }

    public function delete(Film $film)
    {
        // Удаляем изображение, если оно есть
        if ($film->link) {
            Storage::disk('public')->delete($film->link);
        }

        // Удаляем связи с жанрами
        $film->genres()->detach();

        // Удаляем фильм
        $film->delete();

        return redirect()->route('film.index')->with('success', 'Film deleted successfully.');
    }

    public function publish(Film $film)
    {
        $film->update(['published' => true]);
        return redirect()->route('film.show', $film->id)->with('success', 'Film published successfully.');
    }

}