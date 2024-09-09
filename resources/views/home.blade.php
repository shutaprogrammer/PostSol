@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('新規登録完了！') }}
                </div>
            </div>
        </div>
    </div>
    <a href="/tops/{{ $user->id }}/create_profile">プロフィール作成</a>
</div>
@endsection
