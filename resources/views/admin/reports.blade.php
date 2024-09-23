@extends('admin.admin_layout')
@section('content')


    <h1>悪質ユーザー報告</h1>

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

    <div class="mt-5 table-responsive d-flex justify-content-center text-center">
        <table class="table table-bordered mx-auto" style="width: 70%;">
            <thead class="table-light">
                <tr scope="col">
                    <th style="width: 150px">報告日</th>
                    <th style="width: 180px">悪質なユーザー</th>
                    <th style="width: 180px">報告理由</th>
                    <th style="width: 100px"></th>
                </tr>
            </thead>

            @foreach ($reports as $report)
            <tbody>
                <tr scope="row">
                    <td>{{ $report->created_at->format('Y/m/d H:i') }}</td>
                    <td>{{ $report->post->user->name }}（{{ $report->post->user->email }}）</td>
                    <td>{{ $report->reason }}</td>
                    <td>
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#reportModal-{{ $report->id }}">
                        詳細
                        </button>
                    </td>
                </tr>
            </tbody>
            <div class="modal fade" id="reportModal-{{ $report->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $report->created_at->format('Y/m/d H:i:s') }}受信</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item">投稿者：{{ $report->post->user->name }}（{{ $report->post->user->email }}）</li>
                                <li class="list-group-item">投稿内容：{{ $report->post->content }}</li>
                                <li class="list-group-item">理由：{{ $report->reason }}</li>
                                <li class="list-group-item">{{ $report->detail }}</li>
                                <li class="list-group-item">報告者：{{ $report->user->name }}（{{ $report->user->email }}）</li>
                            </ul> 
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $reports->links('pagination::bootstrap-4') }}
    </div>

    <div class="d-flex justify-content-center">
        <a href="{{ route('admin.menu') }}"><button type="button" class="btn btn-outline-secondary">管理者TOPへ戻る</button></a>
    </div>

@endsection