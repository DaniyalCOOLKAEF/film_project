<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $genre->title }} - Details</title>
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
        .buttons a {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .buttons a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
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
                                <td><a href="{{ route('film.show', $film->id) }}">{{ $film->title }}</a></td>
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
</body>
</html>