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
        /* table {
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
        } */
        .section {
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        form label {
            display: block;
            margin-bottom: 3px;
            margin-top: 10px;
            font-weight: bold;
            font-size: 20px;
            text-align: left;
            margin-left: 4%;
        }
        form input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }   
        .image {
            margin-top: 10px;
            
        }
        .image input[type="file"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Movies and Genres</h1>
           
            <form action="{{ route('film.edit') }}" method="post">
            @csrf
            @patch
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter film title..." required>
            
                <label for="genre">Genre</label>
                <input type="text" name="genre" id="genre" placeholder="Enter film genre..." required>
                
                <div class="image">
                <label for="image">Image</label>
                <!-- <input type="file" name="image" id="image" placeholder="Enter film genre..."> -->
                <input type="text" name="image" id="image" placeholder="Enter film genre...">
                </div>

                <input type="submit" value="Update" style="margin-top: 20px; padding: 10px 20px; font-size: 16px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">
            </form>
            
        </div>
    </div>
</body>
</html>