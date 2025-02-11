<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; 

class MovieController extends Controller
{
    // //全てのデータ情報を取得するもの
    // public function index(){

    //     $movies = Movie::all();
    //     return view('index', ['movies' => $movies]);    
    // }

    public function index(Request $request)
    {
        $query = Movie::query();

        // キーワード検索
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // 公開状況のフィルタリング
        if ($request->filled('is_showing')) {
            $isShowing = $request->input('is_showing');
            $query->where('is_showing', $isShowing);
        }

        // ページネーション
        $movies = $query->paginate(20);

        return view('index', compact('movies'));

    }

}

