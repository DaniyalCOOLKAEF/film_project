<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $film->title }} - Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .section {
            margin-bottom: 20px;
        }
        .buttons {
            text-align: center;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .buttons a, .buttons form {
            display: inline-block;
        }
        .buttons button, .buttons a {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .buttons button:hover, .buttons a:hover {
            background-color: #45a049;
        }
        .poster img {
            max-width: 200px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .status {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
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
</body>
</html>