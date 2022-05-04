@extends('page')

@section('title', 'FTL: Груз')

@section('content_header')
    Груз
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
{{--            <div class="col-2">@include('cargo._filter')</div>--}}
            <div class="col-12">
{{--                <a href="{{route('gettingactcargo.create')}}" class="btn btn-success">Добавить</a>--}}
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@sortablelink('gettingAct.date', 'Дата приема')</th>
                        <th>@sortablelink('name', 'Груз')</th>
                        <th>@sortablelink('client_id', 'Клиент Название')</th>
                        <th>@sortablelink('client.inn', 'Клиент ИНН')</th>
                        <th>@sortablelink('status', 'Статус')</th>
                        <th>@sortablelink('weight', 'Масса, кг')</th>
                        <th>@sortablelink('volume', 'Объём, м3')</th>
                        <th>@sortablelink('download_type', 'Тип Загрузки')</th>
                        <th>@sortablelink('pallet_size', 'Размер Паллет')</th>
                        <th>@sortablelink('amount', 'Кол-во')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($cargos))
                        @foreach($cargos as $cargo)
                            <tr onclick="location.href ='{{route('gettingact.edit', ['gettingact' => $cargo->gettingAct])}}'">
                                <td>{{ $cargo->gettingAct->date }}</td>
                                <td>{{ $cargo->name }}</td>
                                <td>{{ optional($cargo->client)->name }}</td>
                                <td>{{ optional($cargo->client)->inn }}</td>
                                <td>{{ !empty($cargo->status) ? \App\Models\Entities\GettingActCargo::statusesList()[$cargo->status] : '' }}</td>
                                <td>{{ $cargo->weight }}</td>
                                <td>{{ $cargo->volume }}</td>
                                <td>{{ $cargo->download_type == 'pallet' ? 'Паллет' : 'Навал' }}</td>
                                <td>{{ $cargo->pallet_size }}</td>
                                <td>{{ $cargo->amount }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {!! $cargos->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@stop
