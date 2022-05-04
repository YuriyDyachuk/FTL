@extends('page')

@section('title', 'FTL: Заявки')

@section('content_header')
    Заявки @include('partials.title', ['text' => App\Title::get()['ordersIndex']['orderForm']])
@stop

@section('content')
    <div class="">
        <div class="">
            <div class="col-sm-12">

                <div class="row">
                    <div class="col-md-2">
                        @if($orders->first()->isSingle())
                            <div class="form-group">
                                <a href="{{route('order.createsingle')}}" class="btn btn-primary btn-block">Склад: Приём Заявка</a>
                            </div>
                        @endif
                        @include('order._filter', ['route' => \Route::getCurrentRoute()->uri])
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
                            @if(!empty($orders))
                                @foreach($orders as $order)
                                    <tr onclick="location.href ='{{route('order.edit', ['order' => $order])}}'">
                                        <td>{{ $order->lead_id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ optional($order->lead->client)->name }}</td>
                                        <td>{{ \App\Models\Entities\Order::orderNames()[$order->name] }}</td>
                                        <td class="@php echo \App\Models\Entities\EntityStatus::getStatusColor($order->status); @endphp"><span class="d-none">{{$order->status}}</span></td>
                                        <td></td>
                                        <td>{{ optional($order->activeResponsibleUser)->name }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $orders->appends(\Request::except('page'))->render() !!}
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
