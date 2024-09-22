@extends('admin.admin_layout')
@section('content')

    <style>
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

    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

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
                    {{ $contact->status }} <small>（更新日：{{ $contact->updated_at->format('Y/m/d H:i') }}）</small>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">送信者：{{ $contact->user->name }}（{{ $contact->user->email }}）</li>
                    <li class="list-group-item">返信先：{{ $contact->email }}</li>
                    <li class="list-group-item">〈{{ $contact->category }}〉{{ \Illuminate\Support\Str::limit($contact->title, 15, '...') }}</li>
                    <li class="list-group-item">{{ \Illuminate\Support\Str::limit($contact->detail, 50, '...') }}</li>
                    <li class="list-group-item d-flex">
                        <button type="button" class="btn btn-outline-dark ms-auto" data-bs-toggle="modal" data-bs-target="#contactModal-{{ $contact->id }}">
                            詳細
                        </button>

                        <!-- Modal -->
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
                    </li>

                    {{-- <li class="list-group-item">
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
                    </li>  --}}
                </ul>
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

@endsection