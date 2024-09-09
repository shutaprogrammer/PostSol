@extends('layouts.app_original')
@section('content')
<form action="{{ route('questions.store') }}" method="POST">
    @csrf
{{-- <input type="hidden" name="user_id"  value="{{ $user->id }}"> --}}
        <div>
            <label for="job">職業</label>
            <input type="text" placeholder="あなたの職業を入力してください" id="job" name="job">
        </div>
        <div>
            <label for="marital">未既婚</label>
            <input type="text" placeholder="未婚または既婚と入力してください" id="marital" name="marital" >
        </div>
        <div>
            <label for="children">子供の人数</label>
            <input type="text" placeholder="子供の人数を入力してください" id="children" name="children" >
        </div>
        <div>
            <label for="salary">世帯年収</label>
            <input type="text" placeholder="世帯年収を入力してください" id="income" name="salary" >
        </div>
        <div>
            <label for="business">今後行いたいビジネスはなんですか？</label>
            <br>
            <textarea id="business" cols="30" rows="10" placeholder="今後行いたいビジネスがあれば入力してください" name="business"></textarea>
        </div>
        <button type="submit">登録</button>
</form>
@endsection
