@extends('page')

@section('title', 'FTL: Изменение размера фасовки')

@section('content_header')
    Изменение размера фасовки
@stop

@section('content')
    @include('errors')
    <div class="col-sm-3 pl0">
        <form action="{{ route('packingsizecatalog.update', ['size' => $size]) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label>Размер</label>
                <input type="text" name="size" class="form-control" value="{{ $size->size }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@stop
