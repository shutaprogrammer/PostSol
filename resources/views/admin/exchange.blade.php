@extends('admin.admin_layout')
@section('content')

        <h1>Amazonギフト換金履歴</h1>

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



    <div class="mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ユーザー</th>
                    <th scope="col">購入数</th>
                    <th scope="col">Coin使用数</th>
                    <th scope="col">購入日時</th>
                </tr>    
            </thead>
            <tbody>
                @foreach ($gifts as $gift)
                <tr>
                    <td>{{ $gift->user->name }}（{{ $gift->user->email }}）</td>
                    <td>{{ $gift->number }}</td>
                    <td>{{ $gift->money }}</td>
                    <td>{{ $gift->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{  $gifts->links('pagination::bootstrap-4') }}
    </div>

    <div class="mt-3 d-flex justify-content-center">
        <a href="{{ route('admin.menu') }}"><button type="button" class="btn btn-outline-secondary">管理者TOPへ戻る</button></a>
    </div>

@endsection