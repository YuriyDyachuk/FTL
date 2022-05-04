@extends('page')

@section('title', 'FTL: Тип Груза')

@section('content_header')
    Тип Груза
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{--            <div class="col-2">@include('cargo._filter')</div>--}}
            <div class="col-12">
                <a href="{{ route('cargotypes.create') }}" class="btn btn-success">Добавить</a>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@sortablelink('id', '№')</th>
                        <th>@sortablelink('name', 'Название')</th>
                        <th>@sortablelink('download_type', 'Тип Загрузки')</th>
                        <th>@sortablelink('pallet_size', 'Размер Паллет')</th>
                        <th>@sortablelink('client_id', 'Клиент')</th>
                        <th>@sortablelink('provider_name', 'Поставщик')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($entities))
                        @foreach($entities as $entity)
                            <tr onclick="location.href ='{{route('cargotypes.edit', ['cargotype' => $entity])}}'">
                                <td>{{ $entity->id }}</td>
                                <td>{{ $entity->name }}</td>
                                <td>{{ $entity->download_type == 'pallet' ? 'Паллет' : 'Навал' }}</td>
                                <td>{{ $entity->pallet_size }}</td>
                                <td>{{ optional($entity->client)->name }}</td>
                                <td>{{ $entity->provider_name }}</td>
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
