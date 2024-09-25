@foreach ($contacts as $contact)
<div class="card m-4" style="width: 20rem;">
    <div style=" font-weight: bold;" class="card-header
        @if ($contact->status == '未')
            status-unread
        @elseif ($contact->status == '対応中')
            status-inprogress
        @elseif ($contact->status == '完了')
            status-complete
        @endif">
        {{ $contact->status }}
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">受信日{{ $contact->created_at->format('Y/m/d H:i') }}</li>
        <li class="list-group-item">送信者：{{ $contact->user->name }}（{{ $contact->user->email }}）</li>
        <li class="list-group-item">返信先：{{ $contact->email }}</li>
        <li class="list-group-item">〈{{ $contact->category }}〉{{ \Illuminate\Support\Str::limit($contact->title, 15, '...') }}</li>
        <li class="list-group-item">{{ \Illuminate\Support\Str::limit($contact->detail, 50, '...') }}</li>
        <li class="list-group-item d-flex">
            <small>更新：{{ $contact->updated_at->format('Y/m/d H:i') }}</small>
            <button type="button" class="btn btn-outline-dark ms-auto" data-bs-toggle="modal" data-bs-target="#contactModal-{{ $contact->id }}">
                詳細
            </button>
        </li>
    </ul>
</div>
@endforeach

        <!-- Modal -->
        @foreach($contacts as $contact)
        <div class="modal fade" id="contactModal-{{ $contact->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $contact->created_at }}受信</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item">投稿者：{{ $contact->user->name }}</li>
                            <li class="list-group-item">返信先：{{ $contact->user->email }}</li>
                            <li class="list-group-item">タイトル：〈{{ $contact->category }}〉{{ $contact->title }}</li>
                            <li class="list-group-item">詳細：{{ $contact->detail }}</li>
                        </ul> 
                    </div>
                    <div class="modal-footer">
                        <div>ステータス変更日:{{ $contact->updated_at }}</div>
                        <div class="btn-group">
                            <form action="{{ route('contact.status', $contact->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    <option value="未" {{ $contact->status == '未' ? 'selected' : '' }}>未</option>
                                    <option value="対応中" {{ $contact->status == '対応中' ? 'selected' : '' }}>対応中</option>
                                    <option value="完了" {{ $contact->status == '完了' ? 'selected' : '' }}>完了</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

