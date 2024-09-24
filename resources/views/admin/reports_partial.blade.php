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