@extends('layouts.main')
@section('content')


    <div class="container">
        <h1>{{ $genre->title }}</h1>
        <div class="section">
            <h2>Films in Genre: {{ $genre->name }}</h2>
            @if ($genre->films->isNotEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genre->films as $film)
                            <tr>
                                <td>{{ $film->id }}</td>
                                <td><a href="{{ route('genre.show', $film->id) }}">{{ $film->title }}</a></td>
                                <td>{{ $film->published ? 'Published' : 'Not Published' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No films assigned to this genre.</p>
            @endif
        </div>
        <div class="buttons">
            <a href="{{ route('film.index') }}">Go Back</a>
        </div>
    </div>
@endsection