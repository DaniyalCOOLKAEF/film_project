<?php

namespace App\Services;

use App\Models\Film;
use Illuminate\Support\Facades\Storage;

class FilmService
{
    public function store(array $data): Film
    {
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
        if (! empty($data['genre_id'])) {
            $film->genres()->attach($data['genre_id']);
        }

        return $film;
    }

    public function update(array $data, $film): Film
    {
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
        if (! empty($data['genre_id'])) {
            $film->genres()->sync($data['genre_id']);
        } else {
            $film->genres()->detach();
        }

        return $film;
    }

    public function destroy($film): Film
    {
        // Удаляем изображение, если оно есть
        if ($film->link) {
            Storage::disk('public')->delete($film->link);
        }

        // Удаляем связи с жанрами
        $film->genres()->detach();

        // Удаляем фильм
        $film->delete();

        return $film;
    }
}
