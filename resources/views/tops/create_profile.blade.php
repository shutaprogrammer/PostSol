@extends('layouts.app')
@section('content')
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="img">アイコン</label>
            <input type="file" name="img" id="img">
        </div>

        <div>
            <label>性別</label>
                <input type="radio" id="male" name="gender" value="男性">
                <label for="male">男性</label>
                <input type="radio" id="female" name="gender" value="女性">
                <label for="female">女性</label>
                <input type="radio" id='no_ansewer' name="gender" value="未回答">
                <label for="no_answer">未回答</label>
        </div>

        <div>
            <label>生まれ年</label>
            <input type="text" name="birth">
        </div>

        <div>
            <label>お住まいの国</label>
            <input type="text" name="country">
        </div>

        <div>
            <label>お住まいの都道府県/州</label>
            <input type="text" name="prefecture">
        </div>

        <div>
            <label>お住まいの市町村</label>
            <input type="text" name="city">
        </div>

        <button type="submit">プロフィール作成</button>
        </form>
    </div>
@endsection