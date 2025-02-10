<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;

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

//　MovieControllerに対してデータを渡すルーティング
Route::get('/movies', [MovieController::class, 'index']);


//　管理者用のルーティング設定を行う
Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
//個別の映画を取得するためのルーティング
Route::get('/admin/movies/{id}', [AdminMovieController::class, 'show'])->name('admin.movies.show');


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

