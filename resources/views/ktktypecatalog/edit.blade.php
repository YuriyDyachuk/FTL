@extends('page')

@section('title', 'FTL: Изменение Типа')

@section('content_header')
    Изменение Типа
@stop

@section('content')
    @include('errors')
    <div class="col-sm-3 pl0">
        <form action="{{ route('ktktypecatalog.update', ['type' => $type]) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label>Название</label>
                <input type="text" name="name" class="form-control" value="{{ $type->name }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@stop
