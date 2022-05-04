@extends('page')

@section('title', 'FTL: Задачи в отдел Склад')

@section('content_header')
    Задачи в отдел Склад
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">@include('tasks.wh._filter')</div>
            <div class="col-10">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@sortablelink('orderId', 'Индекс Заявки')</th>
                        <th>Тип заявки</th>
                        <th>@sortablelink('clientName', 'Клиент')</th>
                        <th>Загрузки: Время</th>
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
                            <td>{{ $entity->date }}</td>
                            <td>{{ $entity->order->activeResponsibleUser->name }}</td>
                            <td class="{{ \App\Models\Entities\EntityStatus::getStatusColor($entity->status) }}"><span class="d-none">{{ $entity->status }}</span></td>
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
