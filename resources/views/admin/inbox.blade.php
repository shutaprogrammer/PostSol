@extends('admin.admin_layout')
@section('content')


    <style>
            #serach {
        display: flex !important; /* フレックスボックスを使って配置 */
        justify-content: end !important; /* スペースを均等に分配 */
    }

    @media (max-width: 768px) {
        #search-var {
            justify-content: end !important;
            margin-left: 25px;
        }
    }

    @media (max-width: 767px) {
        #button {
            display: flex;
            justify-content: end;
        }
    }


    .btn {
        min-width: 80px; /* 最小幅を設定 */
        padding: 5px 8px; /* パディングを調整 */
        font-size: 1rem; /* フォントサイズを調整 */
        line-height: 1.5;
    }
    
    @media (min-width: 768px) {
        .btn {
            min-width: 100px; /* PCでは幅を広く */
        }
    }

    @media (max-width: 767px) {
        .btn {
            min-width: 80px; /* スマホでは幅を狭く */
        }
    }




    @media (max-width: 768px) {
        table {
            font-size: 14px; /* フォントサイズを小さく */
            width: 100%; /* 幅を100%に設定 */
        }
        th, td {
            white-space: nowrap; /* テキストの折り返しを防ぐ */
            overflow: hidden; /* はみ出した部分を隠す */
            text-overflow: ellipsis; /* はみ出した部分に省略記号を表示 */
        }
    }

        /* 未読 */
        .all{
            background-color: #ffffff !important; 
            color: #000000 !important;
        }
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

        .nav-link.active {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: bold;
        }

        /* ベース */
        .pagination .page-link {
            color: rgb(84, 84, 100);
        }

        /* ホバー時 */
        .pagination .page-link:hover {
            background-color: rgb(84, 84, 100); /* ホバー時の色 */
            color: white;
        }

        /* アクティブ */
        .pagination .active .page-link {
        background-color: rgb(84, 84, 100);
        color: white; 
    }
    </style>

    <h1>お問い合わせ受信BOX</h1>

    {{-- 検索 --}}
    <nav class="navbar" style="width: 90%;" id="search-var">
        <div class="container-fluid" id="serach">
            <form method="GET" action="{{ route('admin.inbox') }}">
                <div class="row" id="input">

                    <div class="col-12 col-md-3 mb-2">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}" /> <!-- 日付入力 -->
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <input type="text" name="query" class="form-control" value="{{ request('query') }}" placeholder="user名/理由">
                    </div>
                    
                    <div id="button" class="col-12 col-md-3 mb-1 d-flex">
                        <button type="submit" class="btn btn-outline-success btn-sm me-2">検索</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="reset-btn">リセット</button>
                    </div>
                </div>
            </form>
        </div>
    </nav>

    <div class="mt-3">
        <ul class="nav nav-tabs justify-content-end">
            <li class="nav-item">
                <a class="all nav-link {{ request()->routeIs('admin.inbox') ? 'active' : '' }}" aria-current="page" href="{{ route('admin.inbox') }}">一覧BOX</a>
            </li>
            <li class="nav-item">
                <a class="status-unread nav-link {{ request()->routeIs('admin.inbox.unread') ? 'active' : '' }}" href="{{ route('admin.inbox.unread') }}">未BOX</a>
            </li>
            <li class="nav-item">
                <a class="status-inprogress nav-link {{ request()->routeIs('admin.inbox.inprogress') ? 'active' : '' }}" href="{{ route('admin.inbox.inprogress') }}">対応中BOX</a>
            </li>
            <li class="nav-item">
                <a class="status-complete nav-link {{ request()->routeIs('admin.inbox.complete') ? 'active' : '' }}" href="{{ route('admin.inbox.complete') }}">完了BOX</a>
            </li>
        </ul>
    </div>
    <div class="row d-flex justify-content-center">
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
                    {{ $contact->status }} <small></small>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">受信日{{ $contact->created_at->format('Y/m/d H:i') }}</li>
                    <li class="list-group-item">送信者：{{ $contact->user->name }}（{{ $contact->user->email }}）</li>
                    <li class="list-group-item">返信先：{{ $contact->email }}</li>
                    <li class="list-group-item">〈{{ $contact->category }}〉{{ \Illuminate\Support\Str::limit($contact->title, 15, '...') }}</li>
                    <li class="list-group-item">{{ \Illuminate\Support\Str::limit($contact->detail, 50, '...') }}</li>
                    <li class="list-group-item d-flex">
                        <small>更新：{{ $contact->updated_at->format('Y/m/d H:i') }}</small>
                        <button type="button" class="btn btn-outline-dark ms-auto bt-sm" data-bs-toggle="modal" data-bs-target="#contactModal-{{ $contact->id }}">
                            詳細
                        </button>
                    </li>
                </ul>
            </div>
        @endforeach



        <!-- Modal -->
        @foreach($contacts as $contact)
        <div class="modal fade" id="contactModal-{{ $contact->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $contact->created_at }}受信</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item">投稿者：{{ $contact->user->name }}</li>
                            <li class="list-group-item">返信先：{{ $contact->user->email }}</li>
                            <li class="list-group-item">タイトル：〈{{ $contact->category }}〉{{ $contact->title }}</li>
                            <li class="list-group-item">詳細：{{ $contact->detail }}</li>
                        </ul> 
                    </div>
                    <div class="modal-footer">
                        <div>ステータス変更日:{{ $contact->updated_at }}</div>
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
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ページネーションを追加 -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $contacts->links('pagination::bootstrap-4') }}
    </div>


    <div class="mt-3 d-flex justify-content-center">
        <a href="{{ route('admin.menu') }}"><button type="button" class="btn btn-outline-secondary">管理者TOPへ</button></a>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'GET',
                data: $(this).serialize(),
                success: function(response){
                    $('.row.d-flex.justify-content-center').html(response);
                }
            });

        });

    
        $('#reset-btn').on('click', function(){

                $('input[name="query"]').val('');
                $('input[name="date"]').val('');
                $("form").submit();

            });
    });
</script>

@endsection