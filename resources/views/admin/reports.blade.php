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
</style>


    <h1>悪質ユーザー報告</h1>

    {{-- 検索 --}}
    <nav class="navbar" style="width: 90%;" id="search-var">
        <div class="container-fluid" id="serach">
            <form method="GET" action="{{ route('admin.reports') }}">
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

    <div class="mt-5 table-responsive d-flex justify-content-center text-center">
        <table class="table align-middle table-bordered mx-auto" style="width: 100%;">
            <thead class="table-light">
                <tr scope="col">
                    <th style="width: 25%">報告日</th>
                    <th class="text-wrap" style="width: 25%">悪質User</th>
                    <th style="width: 25%">報告理由</th>
                    <th style="width: 25%"></th>
                </tr>
            </thead>

            
            <tbody id="reports-table-body">
                @foreach ($reports as $report)
                <tr scope="row">
                    <td>{{ $report->created_at->format('Y/m/d') }}</td>
                    <td>{{ $report->post->user->name }}</td>
                    <td>{{ $report->reason }}</td>
                    <td>
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#reportModal-{{ $report->id }}">
                        詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

    {{-- 詳細の中身 --}}
    @foreach($reports as $report)
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

    {{-- <div class="d-flex justify-content-center">
        {{ $reports->links('pagination::bootstrap-4') }}
    </div> --}}

    <div class="d-flex justify-content-center">
        <a href="{{ route('admin.menu') }}"><button type="button" class="btn btn-outline-secondary">管理者TOPへ戻る</button></a>
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
                        $('#reports-table-body').html(response);
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