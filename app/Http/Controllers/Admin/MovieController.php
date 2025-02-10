<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //インデックスページ
    public function index(){

        $movies = Movie::all();
        return view('admin.movies.index', ['movies' => $movies]);    
    }

    //個別のIDのデータを取得するもの
    public function show($id){

        $movie = Movie::findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }   
}
