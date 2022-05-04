@extends('page')

@section('title', 'FTL: Новый размер фасовок')

@section('content_header')
    Новый размер
@stop

@section('content')
    @include('errors')
    <div class="col-sm-3">
        <form action="{{route('packingsizecatalog.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Размер</label>
                <input type="text" name="size" class="form-control" value="{{ old('size') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@stop
