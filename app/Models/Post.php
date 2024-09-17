<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    //userとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //ブックマークとのリレーション
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    //いいねとのリレーション
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //ソフトデリート
    use SoftDeletes;
    protected $dates = ['deleted_at']; // deleted_atカラムを使用

    //Reportとのリレーション
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
