@extends('page')

@section('title', 'FTL: Задачи в ЖД отдел')

@section('content_header')
    Задачи в ЖД отдел
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">@include('tasks.tr._filter')</div>
            <div class="col-10">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@sortablelink('orderId', 'Индекс Заявки')</th>
                        <th>Тип Заявки</th>
                        <th>@sortablelink('clientName', 'Клиент')</th>
                        <th>@sortablelink('date_from', 'Отправление')</th>
                        <th>@sortablelink('date_to', 'Прибытие')</th>
                        <th>Ответственный Сотрудник</th>
                        <th>@sortablelink('orderStatus', 'Статус Заявки в Отдел')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($entities))
                    @foreach($entities as $entity)
                        <tr onclick="location.href ='{{route('order.edit', ['order' => $entity['order_id']])}}'">
                            <td>{{ $entity->order_id }}</td>
                            <td>{{ \App\Models\Entities\Order::orderNames()[$entity->order->name] }}</td>
                            <td>{{ $entity->order->lead->client->name }}</td>
                            <td>{{ $entity->type == \App\Models\Entities\Block\TrainOrderBlock::BEGIN_TYPE ? $entity->date : '' }}</td>
                            <td>{{ $entity->type == \App\Models\Entities\Block\TrainOrderBlock::END_TYPE ? $entity->date : '' }}</td>
                            <td>{{ $entity->order->activeResponsibleUser->name }}</td>
                            <td class="{{ \App\Models\Entities\EntityStatus::getStatusColor($entity->order->status) }}"><span class="d-none">{{ $entity->order->status }}</span></td>
                        </tr>
                    @endforeach
                        @endif
                    </tbody>
                </table>
                {!! $entities->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@stop
