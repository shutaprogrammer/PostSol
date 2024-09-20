<style>
    /* フォーム全体 */
.modern-form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f7f7f7;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-family: 'Roboto', sans-serif;
}

/* フォームグループ */
.form-group {
    margin-bottom: 20px;
}

/* ラベル */
.form-label {
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
    display: block;
    font-size: 14px;
}

/* テキスト入力フィールド、セレクト、テキストエリア */
.form-input, .form-select, .form-textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
    background-color: #fff;
    transition: border-color 0.3s;
}

/* フォーカス時のスタイル */
.form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: #007bff;
    outline: none;
}

/* テキストエリア */
.form-textarea {
    resize: vertical;
    min-height: 150px;
}

/* ボタン */
.form-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: block;
    margin: 0 auto;
    width: 100%;
}

/* ボタンホバー時 */
.form-button:hover {
    background-color: #0056b3;
}

/* メディアクエリ（レスポンシブ対応） */
@media (max-width: 768px) {
    .modern-form {
        padding: 15px;
    }

    .form-button {
        width: 100%;
    }
}

</style>

@extends('layouts.app_original')
@section('content')
<form action="{{ route('posts.check') }}" method="POST" class="modern-form">
    @csrf
    <!-- カテゴリ選択 -->
    <div class="form-group">
        <label for="type" class="form-label">カテゴリー</label>
        <select name="category" id="type" class="form-select">
            <option value="" disabled {{ old('category') == '' ? 'selected' : '' }} style="color: gray;">カテゴリーの種類を選んでください</option>
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

    <!-- 場所入力 -->
    <div class="form-group">
        <label for="place" class="form-label">場所</label>
        <input type="text" id="place" name="place" value="{{ old('place') }}" placeholder="投稿場所（国・市町村）を入力してください" class="form-input">
    </div>

    <!-- 内容入力 -->
    <div class="form-group">
        <label for="content" class="form-label">内容</label>
        <textarea id="content" name="content" cols="30" rows="10" placeholder="投稿内容を入力してください" class="form-textarea">{{ old('content') }}</textarea>
    </div>

    <!-- 確認ボタン -->
    <button type="submit" class="form-button">確認</button>
</form>
@endsection