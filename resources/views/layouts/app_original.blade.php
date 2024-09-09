<style>
.custom-navbar {
    background-color: skyblue; /* 好きな色に変更 */
  }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PostSol 〜不満からビジネスへ〜</title>
  <!-- BootstrapのCDNを追加 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <!-- ヘッダー。ハンバーガーメニュー   -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">PostSol 〜不満からビジネスへ〜</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="{{ url('/') }}">トップページ</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('posts.index') }}">投稿一覧表示</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('posts.create') }}">新規投稿作成</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">マイページnot yet</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">プロフィール編集not yet</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('mypages.subscription1') }}">サブスク登録</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">BMコイン購入not yet</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">BMコイン換金not yet</a>
                  </li>

              </ul>
          </div>
      </div>
  </nav>

  </header>
  @yield('content')
  <!-- Bootstrap JavaScriptのCDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>