<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Film;
use App\Models\Genre;
use App\Services\FilmService;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class FilmController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected FilmService $service;

    public function __construct(FilmService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $films = Film::with('genres')->paginate(10);
        $genres = Genre::all();

        return view('film.index', compact('films', 'genres'));
    }

    public function create(): View
    {
        $genres = Genre::all();

        return view('film.create', compact('genres'));
    }

    public function store(StoreFilmRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('film.index')->with('success', 'Film created successfully.');
    }

    public function show(Film $film)
    {
        $film->load('genres');

        return view('film.show', compact('film'));
    }

    public function edit(Film $film): View
    {
        $genres = Genre::all();

        return view('film.edit', compact('film', 'genres'));
    }

    public function update(Film $film, UpdateFilmRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->service->update($data, $film);

        return redirect()->route('film.show', $film->id)->with('success', 'Film updated successfully.');
    }

    public function destroy(Film $film): RedirectResponse
    {
        $this->service->destroy($film);

        return redirect()->route('film.index')->with('success', 'Film deleted successfully.');
    }

    public function publish(Film $film): RedirectResponse
    {
        $film->update(['published' => true]);

        return redirect()->route('film.show', $film->id)->with('success', 'Film published successfully.');
    }
}
