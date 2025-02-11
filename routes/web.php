<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\SheetController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);

//　Modelのデータを取得するルーティング
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

// ユーザー側での処理------------------------------------------------------
//　MovieControllerに対してデータを渡すルーティング
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');;

//　SheetControllerに対してデータを渡すルーティング
Route::get('/sheets', [SheetController::class, 'index'])->name('sheets.index');;

// 管理者側での処理--------------------------------------------------------
//個別の映画への編集画面に移動するためのルーティング
Route::get('/admin/movies/{id}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');

//編集後にupdateを許可するための関数に繋げるルーティング
Route::patch('/admin/movies/{id}/update', [AdminMovieController::class, 'update'])->name('admin.movies.update');

// 映画の削除処理
Route::delete('/admin/movies/{id}/destroy', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');

// 映画の新規登録画面を表示（ここをmoviesに分けずにやったらできた（謎）（これは{id} が先に宣言されていると，全ての文字列がまず，id扱いされるからである）
// なので{id}よりも先に宣言してあげればよし！！
Route::get('/admin/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');

//個別の映画を取得するためのルーティング
Route::get('/admin/movies/{id}', [AdminMovieController::class, 'show'])->name('admin.movies.show');

//　管理者用のルーティング設定を行う(ここに，検索機能を加える)
Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');


// 映画の登録処理（フォーム送信先）
Route::post('/admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');




// Route::get('practice', function() {
//     return response('practice');
// });

// Route::get('practice2', function() {
//     $test = 'practice2';
// return response($test);
// });

// Route::get('practice3', function() {
//     $test = 'test';
// return response($test);
// });

