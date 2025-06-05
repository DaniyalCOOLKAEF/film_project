@extends('layouts.main')
@section('content')

    <div class="container film-show-page">
        <h1>{{ $film->title }}</h1>
        <div class="status">
            Status: {{ $film->published ? 'Published' : 'Not Published' }}
        </div>
        <div class="poster">
            <img src="{{ $film->link_url }}" alt="{{ $film->title }} poster">
        </div>
        <div class="section">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Genres</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $film->id }}</td>
                        <td>{{ $film->title }}</td>
                        <td>
                            @if ($film->genres->isNotEmpty())
                                @foreach ($film->genres as $genre)
                                    {{ $genre->name }}{{ $loop->last ? '' : ', ' }}
                                @endforeach
                            @else
                                No genres assigned
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="buttons">
            <a href="{{ route('film.edit', $film->id) }}">Edit</a>
            @if (!$film->published)
                <form action="{{ route('film.publish', $film->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">Publish</button>
                </form>
            @endif
            <form action="{{ route('film.delete', $film->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this film?')">Delete</button>
            </form>
            <a href="{{ route('film.index') }}">Go Back</a>
        </div>
    </div>
@endsection