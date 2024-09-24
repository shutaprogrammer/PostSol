<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostSol 〜不満からビジネスへ〜</title>
    <!-- BootstrapのCDNを追加 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <style>
    body {
        background-color: #ffffff; /* 背景を白に */
        font-family: Arial, sans-serif; /* 洗練されたフォントを使用 */
        color: #333333; /* 文字色を落ち着いた色に */
    }

    /* ナビゲーションバーのスタイル */
    .custom-navbar {
        background-color: #333333;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* タイトルの色を白に設定 */
    .navbar-brand {
        color: #ffffff !important;
        font-weight: bold;
        font-size: 120%;
        display: flex;
        align-items: center;
    }

    /* 画像のサイズ調整 */
    .navbar-brand img {
        max-height: 40px;
        margin-right: 10px;
    }

    /* フォームのスタイル */
    .container {
        max-width: 700px;
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333333;
    }

    label {
        font-weight: bold;
        margin-top: 10px;
        display: block;
        color: #555555;
    }

    input[type="text"], input[type="file"], select, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    button {
        width: 100%;
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* フッターのスタイル */
    footer {
        background-color: #333333;
        color: #ffffff;
        text-align: center;
        padding: 10px 0;
        margin-top: 40px;
    }
</style>
</head>
<body>

<!-- メインコンテンツ -->
<div class="container mt-5">
    <div class="whole">
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <h2 class="title">プロフィール作成・編集</h2>
        <p>以下の項目にプロフィール情報を入力してください。名前とアイコンのみ他のユーザーに公開されます。<a href="PostSol プライバシーポリシー"></a></p>

        <div class="name">
            <label>●名前</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>
        
        <div class="icon">
            <div>
                <label for="img">●アイコン（ファイルサイズ2MBまで）</label>
            </div>
            <div>
                @if($user->img)
                <div class="text-center mb-4">
                    <p>現在のアイコン</p>
                    <img src="{{ Storage::url('imgs/' .$user->img) }}" alt="" class="rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                @endif
                <input type="file" name="img" id="img">
                <div>※アイコンを変更しない場合、このままにしてください。</div>
            </div>
        </div>

        <div class="gender">
            <label>●性別</label>
            <div>
                <label for="male">男性</label>
                <input type="radio" id="male" name="gender" value="男性" {{ $user->gender == '男性' ? 'checked' : '' }}>
            </div>
            <div>
                <label for="female">女性</label>
                <input type="radio" id="female" name="gender" value="女性" {{ $user->gender == '女性' ? 'checked' : '' }}>
            </div>
            <div>
                <label for="no_answer">未回答</label>
                <input type="radio" id='no_answer' name="gender" value="未回答" {{ $user->gender == '未回答' ? 'checked' : '' }}>
            </div>
        </div>

        <div class="birth">
            <label>●生まれ年</label>
            <select name="birth" id="birth">
                <option value="">選択してください</option>
                @foreach($years as $year)
                <option value="{{ $year }}" {{ $user->birth == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="country">
            <label>●お住まいの国</label>
            <select name="country" id="country">
                <option value="">選択してください</option>
                @foreach($countries as $country)
                <option value="{{ $country }}" {{ $user->country == $country ? 'selected' : '' }}>{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <div class="prefecture">
            <label>●お住まいの都道府県/州</label>
            <select name="prefecture" id="prefecture">
                <option value="">選択してください</option>
                @foreach($prefectures as $prefecture)
                <option value="{{ $prefecture }}" {{ $user->prefecture == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                @endforeach
            </select>
        </div>

        <div class="city">
            <label>●お住まいの市町村</label>
            <input type="text" name="city" placeholder="例：札幌市" value="{{ $user->city }}">
        </div>

        <button type="submit" class="button">プロフィール作成</button>
        </form>
    </div>
</div>

<!-- フッター -->
<footer>
    <p>&copy; 2024 PostSol. All rights reserved.</p>
</footer>

<!-- Bootstrap JavaScriptのCDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



