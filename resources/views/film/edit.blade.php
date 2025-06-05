@extends('layouts.main')
@section('content')

    <div class="container">
        <h1>Edit {{ $film->title }}</h1>
        <form action="{{ route('film.update', $film->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter film title..." required
                    value="{{ $film->title }}">
            </div>

            <div class="form-group">
                <label for="link">Poster</label>
                <div class="current-poster">
                    <p>Current poster:</p>
                    <img src="{{ $film->link_url }}" alt="Current poster">
                </div>
                <input type="file" name="link" id="link" accept="image/*">
            </div>

            <div class="form-group">
                <label for="genre_id">Genres</label>
                <select name="genre_id[]" id="genre_id" multiple>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $film->genres->contains($genre->id) ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="buttons">
                <button type="submit">Update</button>
                <a href="{{ route('film.index') }}">Cancel</a>
            </div>
        </form>
    </div>

@endsection