@extends('page')
@section('title', 'FTL: Все Тесты')

@section('content_header')Все Тесты@stop
@section('content')
    @if(!empty($tests))
        <div class="col-sm-4">
            @foreach($tests as $name => $data)
                <p>
                    <h4>{{ $name }}:</h4>
                </p>
                <ul class="list-group">
                    @foreach($data as $datum)
                        <li style="color: #fff; font-size: 16px;" class="list-group-item {{$datum['class']}}">{{ $datum['symbol'] . ' ' . __('tests.'.$datum['text']) }}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    @else
        <h3>Результаты тестов отсутствуют</h3>
    @endif
@stop
