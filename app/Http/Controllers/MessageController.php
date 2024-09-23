<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller
{

    public function createConversation(Request $request)//マイページにてボタンが押されたときに使用

{
    // まず、条件に一致するレコードを探します(既にconversationレコードがある場合)
    $conversation = Conversation::where(function ($query) use ($request) {
        $query->where('user_one_id', Auth::id())
              ->where('user_two_id', $request->user_two_id);
    })->orWhere(function ($query) use ($request) {
        $query->where('user_one_id', $request->user_two_id)
              ->where('user_two_id', Auth::id());
    })->first();
    
    // レコードが見つからなかった場合は新しく作成します。//最初に送信しようした人をone、送信相手をtwoに入れてconversationsに二人が入ったレコード作成。二人の共通番号を作る唯一のメソッド。
    if (!$conversation) {
        $conversation = Conversation::create([
            'user_one_id' => Auth::id(),
            'user_two_id' => $request->user_two_id
        ]);
    }


    $conversationId = $conversation->id;//レコードからidを抽出
    // 取得もしくは作成したconversationのレコードのidをindexルートを経由して、indexメソッドに$conversationIdを渡す。
    return redirect()->route('messages.index', compact('conversationId'));
}


public function index($conversationId)//conversationIdでDMを特定し、メッセージを含んだ状態でviewを表示するために使用。index viewを表示できる唯一のメソッド。
{
    // メッセージ一覧を取得
    $messages = Message::where('conversation_id', $conversationId)->with('sender')//with senderとすることモデルのリレイションを利用して、index viewにてuserレコードを引っ張れるようにする。
        ->orderBy('created_at', 'asc')
        ->get();//storeメソッドで作成したメッセージを、二人の共有番号であるconversationIdで特定して全取得。

        //相手から送信されたメッセージに既読処理
        Message::where('conversation_id', $conversationId)
       ->where('sender_id', '!=', Auth::id())
       ->update(['is_read' => true]);

    // メッセージ送信ページにデータを渡す
    return view('messages.index', compact('messages', 'conversationId'));//二人の個人チャット(共有しているconversationId)にて全messagesをindex個人チャットviewに渡して表示。
}

public function store(Request $request, $conversationId)//index viewにてメッセージ送信ボタンがお押された際メッセージ作成及び再度index view表示のために使用。メッセージを作る唯一のメソッド。
{
    $user_id = Auth::id();

    // 新しいメッセージインスタンスを作成
    $message = new Message();
    
    // 各プロパティに値を設定
    $message->conversation_id = $conversationId;//二人のDM共有番号を入力
    $message->sender_id = $user_id;//送信者の情報を入力
    $message->message = $request->body;//index viewのinputに入力されたものを
    $message->is_read = false ; //未読で作成

    // データベースに保存
    $message->save();

    // メッセージ作成後リダイレクト
    return redirect()->route('messages.index', compact('conversationId'));//indexルートに共有番号を渡して再度同じDMページを表示。
}



    
    public function inbox()//ハンバーガーのDMを押された時使用
    {
    // ログインユーザーのIDを取得
    $userId = Auth::id();

    // ユーザーが関与するすべての会話を取得
    $conversations = Conversation::where('user_one_id', $userId)
        ->orWhere('user_two_id', $userId)
        ->get();//送信者or受信者として自分のuseridが設定されているconversationの全レコードを取得

    // 各会話について最新のメッセージを取得
    $conversationsWithMessages = $conversations->map(function ($conversation) {
        $latestMessage = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at', 'desc')
            ->first();//取得した全レコード(全会話)が入った$conversationsと、各会話の最後に送信されたメッセージ$latestMessageの入った変数、$conversationsWithMessagesを作成
        $conversation->latestMessage = $latestMessage;//各会話の最後のメッセージとして、上で取得した$latestMessageを代入。
        return $conversation;//$conversationsWithMessagesのファンクションは最終的に、各会話のレコードであり最後のメッセージを含んだ$conversationを渡す。
    });

    // 未読メッセージがある会話のIDを取得
    $unreadConversationIds = Message::join('conversations', 'messages.conversation_id', '=', 'conversations.id')
    ->where(function($query) {
        $query->where('conversations.user_one_id', Auth::id())
              ->orWhere('conversations.user_two_id', Auth::id());
    })
    ->where('messages.sender_id', '!=', Auth::id())
    ->where('messages.is_read', false)
    ->pluck('messages.conversation_id')
    ->unique(); // 重複を除去

    return view('messages.inbox', compact('conversationsWithMessages','unreadConversationIds'));//inboxを表示。
    }    
}
