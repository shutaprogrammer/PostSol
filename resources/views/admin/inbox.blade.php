
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* 未読 */
         .status-unread{
             background-color: #f7e5e7 !important; 
             color: #510e15 !important;
         }
     
         /* 進行中 */
         .status-inprogress{
             background-color: #fdf4da !important; 
             color: #5f4802 !important;
         }
     
         /* 完了 */
         .status-complete{
             background-color: #def8e4 !important;
             color: #104d1e !important;
         }
     </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h1>お問い合わせ受信BOX</h1>
    <div class="row">
        @foreach ($contacts as $contact)
            <div class="card m-4" style="width: 20rem;">
                <div style=" font-weight: bold;" class="card-header
                    @if ($contact->status == '未')
                        status-unread
                    @elseif ($contact->status == '対応中')
                        status-inprogress
                    @elseif ($contact->status == '完了')
                        status-complete
                    @endif">
                    {{ $contact->status }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">送信者：{{ $contact->user->name }}（{{ $contact->user->id }}）</li>
                    <li class="list-group-item">返信先：{{ $contact->email }}</li>
                    <li class="list-group-item">〈{{ $contact->category }}〉{{ $contact->title }}</li>
                    <li class="list-group-item">{{ $contact->detail }}</li>
                    <li class="list-group-item">
                        <div class="btn-group">
                            <form action="{{ route('contact.status', $contact->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    <option value="未" {{ $contact->status == '未' ? 'selected' : '' }}>未</option>
                                    <option value="対応中" {{ $contact->status == '対応中' ? 'selected' : '' }}>対応中</option>
                                    <option value="完了" {{ $contact->status == '完了' ? 'selected' : '' }}>完了</option>
                                </select>
                            </form>
                        </div>
                    </li> 
                </ul>
            </div>
            @endforeach
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <a href="{{ route('admin.menu') }}"><button type="button" class="btn btn-outline-secondary">メニューへ戻る</button></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>