<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>映画リスト</title>
</head>
<body>
    <h1>映画リスト</h1>

    <form action="{{ route('movies.index') }}" method="GET">
        <input type="text" name="keyword" placeholder="キーワードを入力" value="{{ request('keyword') }}">
        <label>
            <input type="radio" name="is_showing" value="" {{ request('is_showing') === null ? 'checked' : '' }}> すべて
        </label>
        <label>
            <input type="radio" name="is_showing" value="1" {{ request('is_showing') == '1' ? 'checked' : '' }}> 公開中
        </label>
        <label>
            <input type="radio" name="is_showing" value="0" {{ request('is_showing') == '0' ? 'checked' : '' }}> 公開予定
        </label>
        <button type="submit">検索</button>
    </form>

    <table border="1">
        <tr>
            <th>タイトル</th>
            <th>公開年</th>
            <th>概要</th>
            <th>上映状況</th>
            <th>ポスター</th>
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->published_year }}</td>
                <td>{{ $movie->description }}</td>
                <td>{{ $movie->is_showing ? '公開中' : '公開予定' }}</td>
                <td><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="100"></td>
            </tr>
        @endforeach
    </table>

    {{ $movies->links() }}
</body>
</html>




<!-- <!DOCTYPE html>
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
        <!-- <li>
                <h2>{{ $movie->title }}</h2>
                <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="150">
        </li>
    @endforeach
    </ul>
</body>
</html> --> 
