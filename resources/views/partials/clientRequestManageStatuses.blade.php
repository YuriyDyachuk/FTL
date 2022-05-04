<div class="client_request_status_btns">
    @if($lead->responsible_user_id == $userManager->getId() || $userManager->hasRole('admin'))

            <form action="{{ route('clientrequests.'.$model->lead->getShortLabel().'.setstatus') }}" method="post" style="display: inline-block;">
            @csrf
                {{ method_field('put') }}
            <input type="hidden" name="id" value="{{$model['id']}}">
        @foreach(App\Models\Entities\EntityStatus::getStatusLabels() as $status => $label)
                    <button name="status" value="{{$status}}" type="submit" class="mb-3 {{ $model['status'] == $status ? 'active_status' : '' }} {{ $status !== App\Models\Entities\EntityStatus::IN_PROCESS_STATUS ? 'text-white' : 'text-black' }} btn client_request_set_order_status {{App\Models\Entities\EntityStatus::getStatusColor($status)}}">{{ $label }}</button>
                @endforeach
        </form>

        @include('partials.title', ['text' => App\Title::get()['clientRequest']['statuses']])
    @endif
</div>
