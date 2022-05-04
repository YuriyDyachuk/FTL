@if($userManager->getId() == $model->lead->responsible_user_id || $userManager->hasRole('admin'))
    <form action="{{ route($route, ['id' => $model->id]) }}" method="post" style="margin: 15px 0;">
        @csrf
        {{ method_field('put') }}
        @foreach(App\Models\Entities\EntityStatus::getStatusLabels() as $status => $label)
            <button name="status" value="{{ $status }}" type="submit" class="mb-3 {{ $model['status'] == $status ? 'active_status' : '' }} btn {{ App\Models\Entities\EntityStatus::getStatusColor($status) }}">{{ $label }}</button>
        @endforeach
    </form>
@endif
