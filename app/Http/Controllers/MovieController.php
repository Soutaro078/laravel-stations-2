<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; 

class MovieController extends Controller
{
    //全てのデータ情報を取得するもの
    public function index(){

        $movies = Movie::all();
        return view('admin.movie.index', ['movies' => $movies]);    
    }

    //　個別のIDのデータを取得するもの
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }

}


