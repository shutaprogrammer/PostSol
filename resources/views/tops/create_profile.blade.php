@extends('layouts.app_original')
<head><link rel="stylesheet" href="{{ asset('css/create_profile.css') }}"></head>
@section('content')

    <div class="whole">
        <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <h2>プロフィールを作成しよう！！</h2>

        <div>
            <div>
            <label for="img">アイコン</label>
            </div>
            <div>
            <input type="file" name="img" id="img" value="{{ $user->img }}">
            </div>
        </div>

        <div>
            <div>
            <label>性別</label>
            </div>
                <div>
                <input type="radio" id="male" name="gender" value="男性">
                <label for="male">男性</label>
                </div>
                <div>
                <input type="radio" id="female" name="gender" value="女性">
                <label for="female">女性</label>
                </div>
                <div>
                <input type="radio" id='no_answer' name="gender" value="未回答">
                <label for="no_answer">未回答</label>
                </div>
        </div>

        <div>
            <div>
            <label>生まれ年</label>
            </div>
            <div>
            <input type="text" name="birth" placeholder="2009年" value="{{ $user->birth }}">
            </div>
        </div>

        <div>
            <div>
            <label>お住まいの国</label>
            </div>
            <div>
            <input type="text" name="country" placeholder="日本" value="{{ $user->country }}">
            </div>
        </div>

        <div>
            <div>
            <label>お住まいの都道府県/州</label>
            </div>
            <div>
            <input type="text" name="prefecture" placeholder="広島県" value="{{ $user->prefecture }}">
            </div>
        </div>

        <div>
            <div>
            <label>お住まいの市町村</label>
            </div>
            <div>
            <input type="text" name="city" placeholder="広島市" value="{{ $user->city }}">
            </div>
        </div>

        <button type="submit" class="button">プロフィール作成</button>
        </form>
    </div>
@endsection

