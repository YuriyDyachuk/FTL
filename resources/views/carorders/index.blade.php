@extends('page')

@section('title', 'FTL: Авто Заявки')

@section('content_header')
    Авто Заявки @include('partials.title', ['text' => App\Title::get()['ordersIndex']['orderForm']])
@stop

@section('content')
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-2">
                        @include('carorders._filter')
                    </div>
                    <div class="col-md-10">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>@sortablelink('lead_id', 'Индекс сделки')</th>
                                <th>@sortablelink('created_at', 'Дата заявки')</th>
                                <th>@sortablelink('clientName', 'Клиент')</th>
                                <th>Тип заявки</th>
                                <th>@sortablelink('order_status', 'Статус')</th>
                                <th>Диспетчер</th>
                                <th>@sortablelink('active_responsible_user_id', 'Активно ответственный')</th>
                                <th>Корректировки</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($entities))
                            @foreach($entities as $entity)
                                @php $route = $entity->getRoute($entity->table); @endphp
                                <tr onclick="location.href ='{{route("$route.edit", ['model' => $entity['origin_id']])}}'">
                                    <td>{{ $entity->lead_id }}</td>
                                    <td>{{ $entity->created_at }}</td>
                                    <td>{{ optional(optional($entity->lead)->client)['name'] }}</td>
                                    <td>{{ $entity->getName($entity->table) }}</td>
                                    <td class="@php echo \App\Models\Entities\EntityStatus::getStatusColor($entity->getOriginStatus()); @endphp"><span class="d-none">{{$entity->getOriginStatus()}}</span></td>
                                    <td></td>
                                    <td>{{ $entity->getActiveResponsibleUserName() }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $entities->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@stop

{{--@section('js')--}}
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $('.table').DataTable({--}}
{{--                order:[1,'desc']--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@stop--}}
