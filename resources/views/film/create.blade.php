@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Add New Film</h1>
        <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                <input type="text" name="title" id="title" placeholder="Enter film title..." required>
            </div>
            <div class="form-group">
                <label for="link">Poster</label>
                <input type="file" name="link" id="link" accept="image/*">
            </div>
            <div class="form-group">
                <label for="genre_ids">Genres</label>
                <select name="genre_id[]" id="genre_id" multiple>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="buttons">
                <button type="submit">Save</button>
                <a href="{{ route('film.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection