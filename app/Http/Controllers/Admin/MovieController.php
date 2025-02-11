<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller
{
    // インデックスページ
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', ['movies' => $movies]);
    }

    //編集画面の表示
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    // 個別のIDのデータを取得するもの
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }

    // 新規登録フォームの表示
    public function create()
    {
        return view('admin.movies.create');
    }

    // 削除処理
    public function destroy($id)
    {
        // 削除対象のデータを取得
        $movie = Movie::findOrFail($id);

        // 削除
        $movie->delete();

        // 成功メッセージをセッションに保存
        Session::flash('success', '映画を削除しました！');

        // 一覧ページにリダイレクト
        return redirect()->route('admin.movies.index');
    }

    // 新規登録処理
    public function store(Request $request)
    {
        // バリデーション（タイトルの重複をチェック）
        $request->validate([
            'title' => 'required|unique:movies,title|max:255',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'), // `published_year` に統一
            'description' => 'required|string',
            'image_url' => 'required|url',
            'is_showing' => 'required|boolean'
        ],);

        // [
        //     'title.required' => 'タイトルは必須です。',
        //     'title.unique' => 'このタイトルはすでに登録されています。',
        //     'published_year.required' => '公開年は必須です。',
        //     'published_year.integer' => '公開年は数値で入力してください。',
        //     'published_year.min' => '公開年は1900年以降を指定してください。',
        //     'published_year.max' => '公開年は未来の年を指定できません。',
        //     'image_url.required' => '画像URLは必須です。',
        //     'image_url.url' => '画像URLの形式が正しくありません。',
        // ]

        // 映画を作成
        Movie::create([
            'title' => $request->title,
            'published_year' => $request->published_year, // `published_year` に統一
            'description' => nl2br(e($request->description)), // 改行を許可
            'image_url' => $request->image_url,
            'is_showing' => (bool) $request->is_showing // `boolean` に変換
        ]);

        // 成功メッセージをセッションに保存
        Session::flash('success', '映画を登録しました！');

        // 一覧ページにリダイレクト
        return redirect()->route('admin.movies.index');
    }

    // 編集後の更新処理
    public function update(Request $request, $id)
    {
        // 更新対象となるデータを取得する
        $movie = Movie::find($id);

        // 入力値チェックを行う
        // タイトルは20文字以内、本文は400文字以内という制限を設ける
        // $validated = $request->validate([
        //     'title' => 'required|max:20',
        //     'description' => 'required|max:400',
        // ]);
        // バリデーション（タイトルの重複をチェック）
        $validated = $request->validate([
            'title' => 'required|unique:movies,title,' . $id . '|max:255',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'), // `published_year` に統一
            'description' => 'required|string',
            'image_url' => 'required|url',
            'is_showing' => 'required|boolean'
        ],);
        // チェック済みの値を使用して更新処理を行う
        $movie->update($validated);

        // 更新後、映画詳細ページにリダイレクトし、成功メッセージを表示
        return redirect()->route('admin.movies.index');
    }
    
}


