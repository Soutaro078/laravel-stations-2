<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - 詳細</title>
</head>
<body>
    <h1>{{ $movie->title }} ({{ $movie->release_year }})</h1>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="200">
    <p><strong>概要:</strong> {{ $movie->description }}</p>
    <p><strong>上映状況:</strong> {{ $movie->status }}</p>
    <a href="{{ route('admin.movies.index') }}">一覧に戻る</a>
</body>
</html>
