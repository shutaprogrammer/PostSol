@extends('layouts.app_original')
@section('content')
<h2>ユーザーランキング</h2>

<table class="table">
    <thead>
        <tr>
            <th>順位</th>
            <th>ユーザー名</th>
            <th>ブックマーク獲得数</th>
        </tr>
    </thead>
    <tbody>
        @foreach($topUsers as $index => $user)
            <tr>
                <td style="padding-left: 8px;">
                    @if($index == 0)
                        <img src="{{ asset('storage/imgs/1st_place.jpg') }}" alt="1位" style="width:40px; height:auto;">
                    @elseif($index == 1)
                        <img src="{{ asset('storage/imgs/2nd_place.jpg') }}" alt="2位" style="width:40px; height:auto;">
                    @elseif($index == 2)
                        <img src="{{ asset('storage/imgs/3rd_place.jpg') }}" alt="3位" style="width:40px; height:auto;">
                    @else
                        <span style="margin-left: 8px;">{{ $index + 1 }}位</span>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->total_bookmarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection