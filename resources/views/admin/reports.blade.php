<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostSol_悪質報告</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>悪質ユーザー報告</h1>
    <div class="mt-5 table-responsive d-flex justify-content-center text-center">
        <table class="table table-bordered mx-auto" style="width: 70%;">
            <thead class="table-light">
                <tr scope="col">
                    <th style="width: 150px">報告日</th>
                    <th style="width: 180px">投稿者</th>
                    <th style="width: 300px">投稿内容</th>
                    <th style="width: 180px">報告理由</th>
                    <th style="width: 400px">詳細</th>
                    <th style="width: 100px"></th>
                </tr>
            </thead>

            @foreach ($reports as $report)
            <tbody>
                <tr scope="row">
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    <td>{{ $report->user->name }}（{{ $report->user->email }}）</td>
                    <td>{{ $report->post->content }}</td>
                    <td>{{ $report->reason }}</td>
                    <td>{{ $report->detail }}</td>
                    <td><button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        詳細
                    </button></td>
                </tr>
            </tbody>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $report->created_at->format('Y-m-d') }}受信</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item">投稿内容：{{ $report->post->content }}</li>
                                <li class="list-group-item"><p><strong>理由：〈{{ $report->reason }}〉</strong>{{ $report->detail }}</p></li>
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
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="d-flex justify-content-center">
        <a href="{{ route('admin.menu') }}"><button type="button" class="btn btn-outline-secondary">管理者TOPへ戻る</button></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>