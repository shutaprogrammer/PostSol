@extends('layouts.app_original')

@section('content')

<style>
    .size {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 50%;
    }
    .imgname{
        display: flex;
        flex-direction: row;
    }
    h5{
        margin: 10px 0 0 8px; 
    }
    .unread-badge {
        color: black;
        margin: 10px 0 0 42vw;
        background-color: red;
        height: 24px;
        width: 38px;
        text-align: center;

    }
    .saigo{
        font-size: 12px;
    }
</style>
    <div class="container mt-5">
        <h2>DM　送受信ボックス</h2>

        <!-- 会話一覧 -->
        <div class="list-group">
            @foreach ($conversationsWithMessages as $conversation)
                @php
                    $otherUserId = $conversation->user_one_id == Auth::id() ? $conversation->user_two_id : $conversation->user_one_id;//oneが自分のidと一致する場合、twoが相手(other)なのでそのユーザーのidを取得。一致しない場合はoneが相手(other)でtwoが自分なので、oneのidを取得。
                    $otherUser = \App\Models\User::find($otherUserId);//otherのユーザーのレコードを$otherUserIdを使って探し出す。
                    $conversationId = $conversation->id;//conversationのidを変数に格納。
                @endphp
                
                {{-- index viewに遷移するaタグを用意。その際に上記の$conversationIdも一緒に渡すことで会話を特定。 --}}
                <a href="{{ route('messages.index', compact('conversationId')) }}" class="list-group-item list-group-item-action">
                    <div class="imgname">
                        <!-- プロフィール画像 -->
                        <div class="twitter__profile">
                            <img src="{{ $otherUser->img ? Storage::url('imgs/' .$otherUser->img) : asset('images/default-profile.png') }}" alt="" class="size">
                        </div>
                        <h5>{{ $otherUser->name }}</h5>
                        <!-- 未読メッセージがある場合の赤い「未読」表示 -->
                        @if ($unreadConversationIds->contains($conversationId))
                            <span class="unread-badge">未読</span>
                        @endif
                    </div>
                    <p><span class="saigo">最後のメッセージ：</span>{{ $conversation->latestMessage ? $conversation->latestMessage->message : 'まだメッセージはありません' }}</p>
                    <small>{{ $conversation->latestMessage ? $conversation->latestMessage->created_at->format('Y-m-d H:i') : '' }}</small>
                </a>
            @endforeach
        </div>
    </div>
@endsection
