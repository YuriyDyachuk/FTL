@extends('page')

@section('title', 'FTL: Новый тип Груза')

@section('content_header')
    Новый тип Груза
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{route('cargotypes.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    @include('cargoTypes._form')
                </div>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@stop
