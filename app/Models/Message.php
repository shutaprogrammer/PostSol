<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

     // fillableプロパティにconversation_idを追加
     protected $fillable = [
        'conversation_id',
        'user_id',    // もし他のフィールドがあればここに追加
        'message',       // 例えばメッセージの内容を保存するフィールド
        // 他のフィールド...
    ];
}
