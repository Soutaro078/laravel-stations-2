<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
    <ul>
    @foreach ($movies as $movie)
        <!-- <li>タイトル: {{ $movie->title }}</li>
        <li>画像のURL {{ $movie->image_url}}</li> -->
        <li>
                <h2>{{ $movie->title }}</h2>
                <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="150">
        </li>
    @endforeach
    </ul>
</body>
</html>
