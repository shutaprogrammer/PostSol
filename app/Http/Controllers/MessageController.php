<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller
{
    public function index($receiverId)
{
    // 送信相手のユーザー情報を取得
    $receiver = User::findOrFail($receiverId);

    // ログインユーザーのIDと送信相手のIDを使って会話を取得（存在しない場合は新規作成する）
    $conversation = Conversation::firstOrCreate(
        ['user_one_id' => Auth::id(),'user_two_id' => $receiver->id,], 
        ['user_one_id' => Auth::id(),'user_two_id' => $receiver->id,]
    );

    // メッセージ一覧を取得
    $messages = Message::where('conversation_id', $conversation->id)
        ->orderBy('created_at', 'asc')
        ->get();

    // メッセージ送信ページにデータを渡す
    return view('messages.index', compact('messages', 'conversation', 'receiver'));
}
    public function store(Request $request, $conversationId)
    {
        // バリデーション
        $request->validate([
            'body' => 'required|string',
        ]);
    
        // 会話を取得
        $conversation = Conversation::findOrFail($conversationId);

        // メッセージを作成（saveメソッドを使用）
        $message = new Message();
        $message->conversation_id = $conversation->id;
        $message->sender_id = Auth::id();
        $message->message = $request->body;
        $message->save();

         // 受信者IDを取得
        // ユーザーが `user_one_id` なら `user_two_id` が相手のID、逆も同じ
        $receiverId = ($conversation->user_one_id === Auth::id()) 
        ? $conversation->user_two_id 
        : $conversation->user_one_id;
    
        // メッセージ送信後、正しい conversationId を使ってリダイレクト
        return redirect()->route('messages.index', ['receiverId' => $receiverId]);
    }

    public function createConversation(Request $request)
{
    $conversation = Conversation::firstOrCreate(
        ['user_one_id' => Auth::id(), 'user_two_id' => $request->user_two_id],
        ['user_two_id' => $request->user_two_id, 'user_one_id' => Auth::id()]
    );

    // 受信者IDを取得してリダイレクト
    $receiverId = $request->user_two_id;
    return redirect()->route('messages.index', ['receiverId' => $receiverId]);
}

    public function inbox()
    {
    // ログインユーザーのIDを取得
    $userId = Auth::id();

    // ユーザーが関与するすべての会話を取得
    $conversations = Conversation::where('user_one_id', $userId)
        ->orWhere('user_two_id', $userId)
        ->get();

    // 各会話について最新のメッセージを取得
    $conversationsWithMessages = $conversations->map(function ($conversation) {
        $latestMessage = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at', 'desc')
            ->first();
        $conversation->latestMessage = $latestMessage;
        return $conversation;
    });

    return view('messages.inbox', compact('conversationsWithMessages'));
    }    
}
