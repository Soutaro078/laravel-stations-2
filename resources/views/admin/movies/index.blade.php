<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>映画管理画面</title>
</head>
<body>
    <h1>映画一覧（管理画面）</h1>
    <table border="1">
        <tr>
            <th>タイトル</th>
            <th>公開年</th>
            <th>概要</th>
            <th>上映状況</th>
            <th>ポスター</th>
            <th>詳細</th>
            <th>編集</th> <!-- 編集ボタンのヘッダーを追加 -->
            <th>削除</th> <!-- 削除ボタンのヘッダーを追加 -->
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->published_year }}</td>
                <td>{{ $movie->description }}</td>
                <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td> <!-- 修正 -->
                <td><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="100"></td>
                <td><a href="{{ route('admin.movies.show', ['id' => $movie->id]) }}">詳細を見る</a></td>
                <td><a href="{{ route('admin.movies.edit', ['id' => $movie->id]) }}"><button>編集</button></a></td>
                <td>
                    <!-- 削除ボタン（確認ダイアログ付き） -->
                    <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>

