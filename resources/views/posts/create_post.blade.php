@extends('layouts.app_original')
@section('content')
<form action="{{ route('posts.check') }}" method="POST">
    @csrf
    <div>
        <label for="type">カテゴリー</label>
    <select name="category" id="type">
            <option value="" disabled {{ old('category') == '' ? 'selected' : '' }} style="color: gray;"> カテゴリーの種類を選んでください </option>
            <option value="食品"{{ old('category') == '食品' ? 'selected' : '' }}>食品</option>
            <option value="飲料"{{ old('category') == '飲料' ? 'selected' : '' }}>飲料</option>
            <option value="コンビニ・小売店・量販店"{{ old('category') == 'コンビニ・小売店・量販店' ? 'selected' : '' }}>コンビニ・小売店・量販店</option>
            <option value="外食・出前・お弁当"{{ old('category') == '外食・出前・お弁当' ? 'selected' : '' }}>外食・出前・お弁当</option>
            <option value="暮らし・住まい"{{ old('category') == '暮らし・住まい' ? 'selected' : '' }}>暮らし・住まい</option>
            <option value="美容・健康"{{ old('category') == '美容・健康' ? 'selected' : '' }}>美容・健康</option>
            <option value="服・アクセサリー"{{ old('category') == '服・アクセサリー' ? 'selected' : '' }}>服・アクセサリー</option>
            <option value="デジタル・家電"{{ old('category') == 'デジタル・家電' ? 'selected' : '' }}>デジタル・家電</option>
            <option value="アプリ・Webサービス"{{ old('category') == 'アプリ・Webサービス' ? 'selected' : '' }}>アプリ・Webサービス</option>
            <option value="生活関連サービス"{{ old('category') == '生活関連サービス' ? 'selected' : '' }}>生活関連サービス</option>
            <option value="医療・福祉"{{ old('category') == '医療・福祉' ? 'selected' : '' }}>医療・福祉</option>
            <option value="自動車"{{ old('category') == '自動車' ? 'selected' : '' }}>自動車</option>
            <option value="宿泊・観光・レジャー"{{ old('category') == '宿泊・観光・レジャー' ? 'selected' : '' }}>宿泊・観光・レジャー</option>
            <option value="アウトドア・スポーツ"{{ old('category') == 'アウトドア・スポーツ' ? 'selected' : '' }}>アウトドア・スポーツ</option>
            <option value="趣味・エンタメ"{{ old('category') == '趣味・エンタメ' ? 'selected' : '' }}>趣味・エンタメ</option>
            <option value="ペット"{{ old('category') == 'ペット' ? 'selected' : '' }}>ペット</option>
            <option value="人間関係"{{ old('category') == '人間関係' ? 'selected' : '' }}>人間関係</option>
            <option value="教育"{{ old('category') == '教育' ? 'selected' : '' }}>教育</option>
            <option value="仕事"{{ old('category') == '仕事' ? 'selected' : '' }}>仕事</option>
            <option value="公共・交通"{{ old('category') == '公共・交通' ? 'selected' : '' }}>公共・交通</option>
            <option value="政治・行政・国際・文化"{{ old('category') == '政治・行政・国際・文化' ? 'selected' : '' }}>政治・行政・国際・文化</option>
            <option value="その他"{{ old('category') == 'その他' ? 'selected' : '' }}>その他</option>
        </select>
    </div>
    <div>
        <label for="place" name="place">場所</label>
    <input type="text" id="place" value="{{ old('place') }}" placeholder="投稿場所（国・市町村）を入力してください" name="place"> 
    </div>
    <div>
        <label for="content">内容</label>
        <br>
    <textarea id="content" cols="30" rows="10" placeholder="投稿内容を入力してください" name="content">{{ old('content') }}</textarea>
    </div>
    <button type="submit">確認</button>
</form>
@endsection