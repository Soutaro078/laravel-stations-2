<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
        $genre = $movie->genre ; // 🔹 紐づいているジャンルを取得（なければ null）

        return view('admin.movies.edit', compact('movie', 'genre'));
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
        $genres = Genre::all(); // ジャンルを取得
        return view('admin.movies.create',compact('genres'));
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
        $request->validate([
            'title' => 'required|string|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|string',
            'is_showing' => 'required|boolean',
            'genre' => 'required|string|max:255', // 🔹 ジャンルは必須
        ]);
        
        try {
            // 🔹 トランザクション開始（ここでIDをとってくる）
            return DB::transaction(function () use ($request) {
                // 🔹 ジャンルを検索（大文字・小文字区別なし）
                $genre = Genre::where('name', $request->input('genre'))->first();
        
                // 🔹 存在しなければ新規作成
                if (!$genre) {
                    $genre = Genre::create(['name' => $request->input('genre')]);
                }

                if (strlen($request->input('title')) > 255) {
                    throw new \Exception('タイトルが長すぎます'); // 500 エラー
                }

                // 🔹 映画のデータを作成
                $movie = Movie::create([
                    'title' => $request->input('title'),
                    'image_url' => $request->input('image_url'),
                    'published_year' => $request->input('published_year'),
                    'description' => $request->input('description'),
                    'is_showing' => $request->input('is_showing'),
                    'genre_id' => $genre->id, // 🔹 紐付け
                ]);
        
                return redirect()->route('admin.movies.index')->with('success', '映画を追加しました');
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 編集後の更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|string',
            'is_showing' => 'required|boolean',
            'genre' => 'required|string|max:255', // 🔹 ジャンルは必須
        ]);
    
        try {
            // 🔹 トランザクション開始
            return DB::transaction(function () use ($request, $id) {
                $movie = Movie::findOrFail($id);
        
                // 🔹 ジャンルを検索
                $genre = Genre::where('name', $request->input('genre'))->first();
        
                // 🔹 存在しなければ新規作成
                if (!$genre) {
                    $genre = Genre::create(['name' => $request->input('genre')]);
                }

                if (strlen($request->input('title')) > 255) {
                    throw new \Exception('タイトルが長すぎます'); // 500 エラー
                }
        
                // 🔹 映画のデータを更新
                $movie->update([
                    'title' => $request->input('title'),
                    'image_url' => $request->input('image_url'),
                    'published_year' => $request->input('published_year'),
                    'description' => $request->input('description'),
                    'is_showing' => $request->input('is_showing'),
                    'genre_id' => $genre->id, // 🔹 紐付け
                ]);
        
                return redirect()->route('admin.movies.index')->with('success', '映画情報を更新しました');
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}


