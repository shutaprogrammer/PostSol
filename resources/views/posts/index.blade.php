@extends('layouts.app_original')
@section('content')
<div>
    @foreach ($posts as $post)
    <div>
        <h3>{{ $post->content }}</h3>
    </div>
        <h5>{{ $post->category }}</h5>
        <h5>{{ $post->place }}</h5>
    @endforeach
</div>
@endsection