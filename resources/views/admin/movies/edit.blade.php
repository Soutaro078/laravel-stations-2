<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録内容の編集</title>
</head>
<body>
    <h1>登録内容の編集</h1>

    <!-- エラーメッセージの表示 -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- フラッシュメッセージの表示 -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label>タイトル:</label>
        <input type="text" name="title" value="{{ old('title', $movie->title) }}"><br>

        <label>公開年:</label>
        <input type="number" name="published_year" min="1900" max="{{ date('Y') }}" value="{{ old('published_year', $movie->published_year) }}"><br>

        <label>概要:</label>
        <textarea name="description">{{ old('description', $movie->description) }}</textarea><br>

        <label>画像URL:</label>
        <input type="url" name="image_url" value="{{ old('image_url', $movie->image_url) }}"><br>

        <label>上映中:</label>
        <input type="checkbox" name="is_showing" value="1" {{ $movie->is_showing ? 'checked' : '' }}><br>

        <button type="submit">修正する</button>
    </form>

    <a href="{{ route('admin.movies.index') }}">一覧に戻る</a>
</body>
</html>
