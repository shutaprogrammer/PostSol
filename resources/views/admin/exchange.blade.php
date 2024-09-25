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

</style>
        <h1>Amazonギフト換金履歴</h1>

    {{-- 検索 --}}
    <nav class="navbar" style="width: 90%;" id="search-var">
        <div class="container-fluid" id="serach">
            <form method="GET" action="{{ route('admin.exchange') }}">
                <div class="row" id="input">

                    <div class="col-12 col-md-3 mb-2">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}" /> <!-- 日付入力 -->
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <input type="text" name="query" class="form-control" value="{{ request('query') }}" placeholder="検索">
                    </div>
                    
                    <div id="button" class="col-12 col-md-3 mb-1 d-flex">
                        <button type="submit" class="btn btn-outline-success btn-sm me-2">検索</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="reset-btn">リセット</button>
                    </div>
                </div>
            </form>
        </div>
    </nav>



    <div class="mt-5 d-flex justify-content-center">
        <table class="table text-center" style="width: 70%">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width:30%">ユーザー</th>
                    <th scope="col" style="width: 15%">AG数</th>
                    <th scope="col" style="width: 15%">消費Coin</th>
                    <th scope="col">購入日時</th>
                </tr>    
            </thead>
            <tbody id="exchange-table-body">
                @foreach ($gifts as $gift)
                <tr>
                    <td>{{ $gift->user->name }}（{{ $gift->user->email }}）</td>
                    <td>{{ $gift->number }}</td>
                    <td>{{ $gift->money }}</td>
                    <td>{{ $gift->created_at ->format('Y/m/d H:i')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <div class="mt-5 d-flex justify-content-center">
        {{  $gifts->links('pagination::bootstrap-4') }}
    </div> --}}

    <div class="mt-3 d-flex justify-content-center">
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
                        $(`#exchange-table-body`).html(response);
                    }
                });
            });

            $(`#reset-btn`).on('click', function(){
                $('input[name="query"]').val('');
                $('input[name="date"]').val('');
                $("form").submit();
            });
        });
    </script>

@endsection