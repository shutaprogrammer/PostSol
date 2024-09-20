@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>受信ボックス</h2>

        <!-- 会話一覧 -->
        <div class="list-group">
            @foreach ($conversationsWithMessages as $conversation)
                @php
                    $otherUserId = $conversation->user_one_id == Auth::id() ? $conversation->user_two_id : $conversation->user_one_id;
                    $otherUser = \App\Models\User::find($otherUserId);
                @endphp
                <a href="{{ route('messages.index', ['conversationId' => $conversation->id]) }}" class="list-group-item list-group-item-action">
                    <h5>{{ $otherUser->name }}</h5>
                    <p>{{ $conversation->latestMessage ? $conversation->latestMessage->message : 'No messages yet' }}</p>
                    <small>{{ $conversation->latestMessage ? $conversation->latestMessage->created_at->format('Y-m-d H:i') : '' }}</small>
                </a>
            @endforeach
        </div>
    </div>
@endsection
