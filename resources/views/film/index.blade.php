@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Movies and Genres</h1>
        <div class="section">
            <a href="{{ route('film.create') }}"
                style="display: inline-block; margin-bottom: 0px; padding: 10px 20px; font-size: 16px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px; text-align: center;">Add
                New Film</a>
            <h2>Films</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($films as $film)
                        <tr>
                            <td>{{ $film->id }}</td>
                            <td><a href="{{ route('film.show', $film->id) }}">{{ $film->title }}</a></td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            {{ $films->links() }}
        </div>

        <div class="section">
            <h2>Genres</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td>{{ $genre->id }}</td>
                            <td><a href="{{ route('genre.show', $genre->id) }}">{{ $genre->name }}</a></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection