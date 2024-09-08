@extends('layouts.app_original')
@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div>
        <label for="type">カテゴリー</label>
        <select name="category" id="type">
            <option value="" selected style="color: gray;"> カテゴリーの種類を選んでください </option>
            <option value="食品">食品</option>
            <option value="飲料">飲料</option>
            <option value="コンビニ・小売店・量販店">コンビニ・小売店・量販店</option>
            <option value="外食・出前・お弁当">外食・出前・お弁当</option>
            <option value="暮らし・住まい">暮らし・住まい</option>
            <option value="美容・健康">美容・健康</option>
            <option value="服・アクセサリー">服・アクセサリー</option>
            <option value="デジタル・家電">デジタル・家電</option>
            <option value="アプリ・Webサービス">アプリ・Webサービス</option>
            <option value="生活関連サービス">生活関連サービス</option>
            <option value="医療・福祉">医療・福祉</option>
            <option value="自動車">自動車</option>
            <option value="宿泊・観光・レジャー">宿泊・観光・レジャー</option>
            <option value="アウトドア・スポーツ">アウトドア・スポーツ</option>
            <option value="趣味・エンタメ">趣味・エンタメ</option>
            <option value="ペット">ペット</option>
            <option value="人間関係">人間関係</option>
            <option value="教育">教育</option>
            <option value="仕事">仕事</option>
            <option value="公共・交通">公共・交通</option>
            <option value="政治・行政・国際・文化">政治・行政・国際・文化</option>
            <option value="その他">その他</option>
        </select>
    </div>
    <div>
        <label for="place" name="place">場所</label>
        <input type="text" id="place" placeholder="投稿場所（国・市町村）を入力してください" name="place"> 
    </div>
    <div>
        <label for="content">内容</label>
        <br>
        <textarea id="content" cols="30" rows="10" placeholder="投稿内容を入力してください" name="content"></textarea>
    </div>
    <button type="submit">新規投稿</button>
</form>
@endsection