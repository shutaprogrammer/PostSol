<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    //ユーザーとのリレーション
    public function users()
    {
        return $this->belongsTo(User::class);
    }


    //postとのリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    

}
