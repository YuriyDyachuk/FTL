@extends('page')

@section('title', 'FTL: Груз')

@section('content_header')
    Груз
@stop

@section('content')
<div class="col-md-4">
    <form action="{{route('cargo.store')}}" method="post">
        @csrf
        @include('cargo._form', ['model' => new \App\Models\Entities\GettingActCargo()])
    </form>
</div>
@stop
