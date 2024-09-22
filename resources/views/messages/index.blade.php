@extends('layouts.app_original')

@section('content')
    <div class="container" style="margin-bottom: 100px;" >
        <h2>{{ $receiver->name }} へのメッセージ</h2>

        <!-- メッセージ一覧表示 -->
        <div class="messages-list">
            @foreach ($messages as $message)
                <div class="message-item">
                <p>{{ $conversation->user_one_id}}</p>
                    <p>{{ $message->message }}</p> <!-- フィールド名を message に変更 -->
                    <span>{{ $message->created_at->format('Y-m-d H:i') }}</span>
                </div>
            @endforeach
        </div>

        <!-- メッセージ送信フォーム -->
        <form action="{{ route('messages.store', ['conversationId' => $conversation->id]) }}" method="POST">
            @csrf
            <div class="form-group mt-4">
                <textarea name="body" class="form-control" rows="3" placeholder="メッセージを入力してください" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">送信</button>
        </form>
    </div>
@endsection