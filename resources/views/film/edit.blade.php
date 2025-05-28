<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $film->title }}</title>
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
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        select {
            height: 150px;
        }
        .buttons {
            text-align: center;
            margin-top: 10px;
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
        .buttons a:hover, .buttons button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .current-poster {
            margin-bottom: 10px;
        }
        .current-poster img {
            max-width: 200px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
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
                <input type="text" name="title" id="title" placeholder="Enter film title..." required value="{{ $film->title }}">
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
</body>
</html>