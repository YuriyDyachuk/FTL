@extends('page')

@section('title', 'FTL: Акт приема')

@section('content_header')
    Акт приема
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{--            <div class="col-2">@include('cargo._filter')</div>--}}
            <div class="col-12">
                <a href="{{ route('gettingact.create') }}" class="btn btn-success">Добавить</a>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>@sortablelink('id', '№')</th>
                        <th>@sortablelink('date', 'Дата')</th>
                        <th>@sortablelink('time', 'Время')</th>
                        <th>@sortablelink('provider_name', 'Поставщик')</th>
                        <th>@sortablelink('client_id', 'Клиент')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($entities))
                        @foreach($entities as $entity)
                                <tr onclick="location.href ='{{route('gettingact.edit', ['gettingact' => $entity])}}'">
                                    <td>{{ $entity->id }}</td>
                                    <td>{{ $entity->date }}</td>
                                    <td>{{ $entity->time }}</td>
                                    <td>{{ $entity->provider_name }}</td>
                                    <td>{{ optional($entity->client)->name }}</td>
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
