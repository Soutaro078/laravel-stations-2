<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; 

class MovieController extends Controller
{
    //全てのデータ情報を取得するもの
    public function index(){

        $movies = Movie::all();
        return view('show', ['movies' => $movies]);    
    }
}


