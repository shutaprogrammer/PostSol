<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PostSol ~ 不満からビジネスに ~</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        <style>
            /* TailwindCSS styles */
            @import url('https://fonts.bunny.net/css?family=figtree:400,600&display=swap');
            * { box-sizing: border-box; }
            body { margin: 0; font-family: 'Figtree', sans-serif; background-color: skyblue; color: #f3f4f6; }
            .container { min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; background: url('data:image/svg+xml,%3Csvg width=\'30\' height=\'30\' viewBox=\'0 0 30 30\' fill=\'none\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z\' fill=\'rgba(255,255,255,0.07)\'/%3E%3C/svg%3E'); background-size: cover; background-position: center; }
            .header {padding: 1rem; text-align: center; }
            .header a { display: inline-block; padding: 0.5rem 1rem; margin-left: 1rem; border-radius: 0.375rem; text-decoration: none; font-weight: 600; }
            .header a:hover { background-color: orange; }
            .login { background-color: darkblue; color: #f3f4f6; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3); }
            .register { background-color: #ef4444; color: #ffffff; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);}
            .title { font-size: 3rem; font-weight: 600; margin-bottom: 1.5rem; text-align: center; }
            .subtitle { 
                font-size: 17px;, margin: 40px 20px; width: 70vw;}
            .smallh1{font-size: 60%}
            .sub{
                display: flex;
                flex-direction: row;
                justify-content: center;
                font-size: 30%;
                font-weight: 600;
            }
            img{
                height: 130px;
                box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
                border-radius: 12%
            }
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
            body {
                font-family: 'Roboto', system-ui, -apple-system, "Segoe UI", sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <img src="{{ Storage::url('imgs/ロゴ.png') }}" alt="ロゴ">
            <div class="text-center">
                <h1 class="title">PostSol  <br><span class="smallh1">~ 不満からビジネスへ ~</span></h1>
                <div class="header">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/mypages/mypage') }}" class="login">マイページ</a>
                        @else
                            <a href="{{ route('login') }}" class="login">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="register">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
                <div class="sub"><p class="subtitle">不満を投稿してポイ活。 <br>不満からビジネスアイデアを思索。</p></div>
            </div>
        </div>
    </body>
</html>


