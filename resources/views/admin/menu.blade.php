<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostSol_管理者メニュー</title>
    <style>
        #header{
            height: 50px;
        }

        #bodyall{
            display: flex;
            flex-direction: row

        }
        #bodyleft{
            border: 1px solid black;
            width: 25vw;
            height: 100vh;
        }

        #bodymiddle{
            width: 50vw;
            font-size: 25px;
        }

        #bodymiddle > ul{
            list-style: none;
            text-decoration: none;
            text-align: center
        }

        #bodyright{
            border: 1px solid black;
            width: 25vw;
            height: 100vh;
        }

        #footer{
            height: 50px;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header id="header">
        <div id="headleft">PostSol</div>
        <div id="headright"></div>
    </header>
    <main>
        <div id="bodyall">
            <div id="bodyleft"></div>
            <div id="bodymiddle" class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ route('admin.reports') }}">通報履歴</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.exchange') }}">アマギフ換金機歴</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.inbox') }}">お問い合わせ受信BOX</a></li>
                    <li class="list-group-item"><a href="#">広告掲載</a></li>
                </ul>
            </div>
            <div id="bodyright"></div>
        </div>
    
    <footer id="footer">
        管理者画面
    </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>