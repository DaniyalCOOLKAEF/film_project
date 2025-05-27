<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies and Genres</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Movies and Genres</h1>
        
        <div class="section">
            <a href="{{ route('film.create') }}" style="display: inline-block; margin-bottom: 0px; padding: 10px 20px; font-size: 16px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px; text-align: center;">Add New Film</a>
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
                            <td><a href="{{ route('film.show', $film->id) }}">{{ $film->id }}</a></td>
                            <td>{{ $film->title }}</td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                            <td>{{ $genre->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>