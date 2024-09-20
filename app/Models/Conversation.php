<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    // fillableプロパティにuser_one_idを追加
    protected $fillable = [
        'user_one_id',
        'user_two_id',  // もし他のフィールドがあればここに追加
        // 他のフィールド...
    ];
}
