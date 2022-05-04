@if($lead->responsible_user_id == $userManager->getId() || $userManager->hasRole('admin'))
    @foreach(App\Models\Entities\EntityStatus::getStatusLabels() as $status => $label)
        <a data-status="{{$status}}" href="#" class="{{ $model['status'] == $status ? 'active_status' : '' }} mb-3 {{ $status !== App\Models\Entities\EntityStatus::IN_PROCESS_STATUS ? 'text-white' : 'text-black' }} btn {{App\Models\Entities\EntityStatus::getStatusColor($status)}}">{{ $label }}</a>
    @endforeach
@endif
@if(empty($viewAll))
    @include('partials.title', ['text' => App\Title::get()['firstOrderForm']['orderFormStatuses'], 'class' => 'firstOrderFormTitle'])
@else
    @include('partials.title', ['text' => App\Title::get()['firstOrderForm']['leadsStatuses']])
@endif
