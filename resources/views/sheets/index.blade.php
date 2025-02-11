<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>座席配置</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        .screen {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2 style="text-align:center;">座席配置</h2>

    <table>
        <!-- スクリーン部分 -->
        <tr>
            <th colspan="{{ count($columns) + 1 }}" class="screen">スクリーン</th>
        </tr>
        
        <!-- 座席部分 -->
        <tr>
            <th></th> <!-- 左上の空白セル -->
            @foreach ($columns as $column)
                <th>{{ $column }}</th> <!-- 列番号 -->
            @endforeach
        </tr>
        
        @foreach ($sheets as $row => $seats)
            <tr>
                <th>{{ $row }}</th> <!-- 行ラベル -->
                @foreach ($columns as $column)
                    @php
                        $seat = $seats->firstWhere('column', $column);
                    @endphp
                    <td>{{ $seat ? $row . '-' . $column : '' }}</td> <!-- 座席情報 -->
                @endforeach
            </tr>
        @endforeach
    </table>

</body>
</html>

