@extends('layouts.app_original')
@section('content')
<style>
  .size {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
  }
  .ranking-icon {
      width: 60px;
      height: 50px;
      object-fit: cover;
  }
  .rank-display {
      text-align: left;
      display: flex;
      align-items: center;

  }
  .rank-text {
      margin-left: 10px; /* 画像と文字の間にスペースを追加 */
  }
</style>

<h2>投稿ランキング（直近３０日間）</h2>

@foreach ($posts as $post)
        <div class="twitter__block">
                <div >
                        <div class="card-body">
                            <!-- 順位 -->
                            <div class="rank-display">
                                @php
                                    $rankImage = '';
                                    switch ($loop->iteration) {
                                        case 1:
                                            $rankImage = Storage::url('imgs/1st_place.jpg');
                                            break;
                                        case 2:
                                            $rankImage = Storage::url('imgs/2nd_place.jpg');
                                            break;
                                        case 3:
                                            $rankImage = Storage::url('imgs/3rd_place.jpg');
                                            break;
                                        default:
                                            $rankImage = ''; // 他の順位の場合は何も表示しない
                                    }
                                @endphp
                    
                                @if ($rankImage)
                                    <img src="{{ $rankImage }}" alt="Rank {{ $loop->iteration }}" class="ranking-icon">
                                @else
                                    <h3 class="rank-text">順位: {{ $loop->iteration }}</h3>
                                @endif
                            </div>
                <!-- プロフィール画像 -->
                <div class="twitter__profile">
                    @if($post->user->img)
                        <img src="{{ Storage::url('imgs/' .$post->user->img) }}" alt="" class="size">
                    @else
                        <!-- デフォルトのプロフィール画像 -->
                        <img src="{{ asset('images/default-profile.png') }}" alt="" class="size">
                    @endif
                </div>
                <!-- 投稿内容 -->
            <div class="twitter__content">
                <!-- ヘッダー（名前と日付） -->
                <div class="twitter__header">
                    <span class="twitter__name">{{ $post->user->name }}</span>
                    <span class="twitter__date">{{ $post->created_at->format('Y年m月d日 H:i') }}</span>
                </div>
                <!-- テキスト -->
                <div class="twitter__text kaigyou">{{ $post->content }}</div>
            <div class="kateact">
                <!-- カテゴリーと場所 -->
                <div class="twitter__text kateba">
                    <strong>#</strong> {{ $post->category }}   
                    <strong>@</strong> {{ $post->place }}
                </div>
                <!-- アクションボタン -->
                <div class="actdura">
                <!-- カウント表示 -->
                <div class="twitter__counts">
                    <span id="bookmark-count-{{ $post->id }}">{{ $post->bookmarks_count }} ブックマーク</span> ・ 
                    <span id="like-count-{{ $post->id }}">{{ $post->likes_count }} いいね</span>
                </div>
                </div>
            </div>
                <!-- 通報リンク -->
                <div class="twitter__text">
                    <a href="{{ route('reports.create', ['post' => $post->id]) }}" class="twitter__report-button">通報する</a>
                </div>
                <!-- アラートメッセージ（投稿に関連付け） -->
                @if(session('alert') && session('alert')['post_id'] == $post->id)
                    <div class="alert alert-danger custom-alert">
                        <strong>注意:</strong> {{ session('alert')['message'] }}
                    </div>
                @endif
            </div>
            <!-- 削除予定日と延長ボタン -->
            <div class="twitter__deletion-date">
                削除予定日: {{ $post->deletion_date->format('Y年m月d日 H:i') }}
                <div class="entyou">
                    <!-- 延長モーダルを表示するボタン -->
                    @if ($post->user_id === Auth::id())
                    <button type="button" data-bs-toggle="modal" data-bs-target="#extendModal-{{ $post->id }}" class="btn btn-extend">
                        <i></i> 延長する
                    </button>
                    @endif
                </div>
            </div>
        </div>

            <!-- ブックマークのモーダル -->
            <div class="modal fade" id="bookmarkModal-{{ $post->id }}" tabindex="-1" aria-labelledby="bookmarkModalLabel-{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: black" id="bookmarkModalLabel-{{ $post->id }}">ブックマークの確認</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                        </div>
                        <div class="modal-body" style="color: black">
                            ⚠️ 10コインを使用してブックマークします。ブックマークは二度と解除できません。それでもよろしいですか？
                        </div>
                        <div class="modal-footer">
                            <form id="bookmarkForm-{{ $post->id }}" action="{{ route('bookmark', $post) }}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-primary bookmark-submit-button" data-id="{{ $post->id }}">はい</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 延長のモーダル -->
            <div class="modal fade" id="extendModal-{{ $post->id }}" tabindex="-1" aria-labelledby="extendModalLabel-{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="color: black" id="extendModalLabel-{{ $post->id }}">削除予定日の延長確認</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                        </div>
                        <div class="modal-body" style="color: black">
                            ⚠️ 100コインを使用して投稿の削除予定日を1日延長します。それでもよろしいですか？
                        </div>
                        <div class="modal-footer">
                            <form id="extendForm-{{ $post->id }}" action="{{ route('posts.extend', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary extend-submit-button" data-id="{{ $post->id }}">はい</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
@endsection

