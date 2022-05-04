@extends('page')

@section('title', 'FTL:  Новый тип КТК')

@section('content_header')
    Новый тип КТК
@stop

@section('content')
    @include('errors')
    <div class="col-sm-3">
        <form action="{{route('ktktypecatalog.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Название</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@stop
