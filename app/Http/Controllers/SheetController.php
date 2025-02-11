<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;

class SheetController extends Controller

{
    // インデックスページ
    public function index()
    {
        $sheets = Sheet::all()->groupBy('row');

        // 全ての列 (column) を取得し、ソートして順序を固定
        $columns = Sheet::select('column')->distinct()->orderBy('column')->pluck('column');

        return view('sheets.index', compact('sheets', 'columns'));
        // return view('sheets.index');
    }
}
