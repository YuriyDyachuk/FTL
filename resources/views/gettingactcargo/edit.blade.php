@extends('page')

@section('title', 'FTL: Груз')

@section('content_header')
    Груз
@stop

@section('content')
    <div class="col-md-4">
        <form action="{{route('cargo.update', ['cargo' => $model])}}" method="post">
            @csrf
            {{ method_field('put') }}
            @include('cargo._form', ['model' => $model])
        </form>
    </div>
@stop
