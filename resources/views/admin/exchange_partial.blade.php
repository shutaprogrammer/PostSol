@foreach ($gifts as $gift)
<tr>
    <td>{{ $gift->user->name }}（{{ $gift->user->email }}）</td>
    <td>{{ $gift->number }}</td>
    <td>{{ $gift->money }}</td>
    <td>{{ $gift->created_at ->format('Y/m/d H:i')}}</td>
</tr>
@endforeach