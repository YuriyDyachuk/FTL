@extends('page')
@section('title', 'FTL: '.$pageName)

@section('content_header')
    {{ $pageName }}
@stop
@section('content')
    @if(!empty($data))
        <div class="col-sm-4">
            <h3>Результаты тестов:</h3>
            <ul class="list-group">
                @foreach($data as $datum)
                    <li style="color: #fff; font-size: 16px;" class="list-group-item {{$datum['class']}}">{{ $datum['symbol'] . ' ' . __('tests.'.$datum['text']) }}</li>
                @endforeach
            </ul>
        </div>
    @else
        <h3>Результаты тестов отсутствуют</h3>
    @endif
@stop
