<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_url', 'published_year', 'description', 'is_showing'];

    // is_showing の値を「上映中」「上映予定」に変換するメソッド
    public function getStatusAttribute()
    {
        return $this->is_showing ? '上映中' : '上映予定';
    }
}
