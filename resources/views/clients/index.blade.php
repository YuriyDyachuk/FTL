@extends('page')

@section('title', 'FTL: Клиенты')

@section('content_header')Клиенты@stop

@section('content')
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('clients.create') }}" class="btn btn-success mb20">Добавить</a>
                <div class="row">
                    <div class="col-md-2">
                        @include('clients._filter')
                    </div>
                    <div class="col-md-10">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>@sortablelink('name', 'Название')</th>
                                <th>@sortablelink('inn', 'ИНН')</th>
                                <th>Город</th>
                                <th>@sortablelink('created_at', 'Регистрация')</th>
                                <th>Последняя сделка</th>
                                <th>Дебиторская задолженность</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entities as $n => $entity)
                                <tr onclick="location.href ='{{route('clients.show', ['client' => $entity])}}'">
                                    <td>{{ ++$n }}</td>
                                    <td>{{ $entity->name }}</td>
                                    <td>{{ $entity->inn }}</td>
                                    <td></td>
                                    <td>{{ $entity->created_at->format('d / m / Y') }}</td>
                                    <td>{{ $entity->leads()->exists() ? $entity->leads->last()->created_at->format('d / m / Y') : '' }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {!! $entities ? $entities->appends(\Request::except('page'))->render() : '' !!}
            </div>
        </div>
    </div>
@stop
