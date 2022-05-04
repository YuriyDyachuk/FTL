@extends('page')

@section('title', 'FTL: Размеры фасовок')

@section('content_header')
    Размер -  {{ $size->size }}
@stop

@section('content')
    <div class="col-sm-12 pl0">
        <p><a href="{{ route('packingsizecatalog.index') }}" class="btn btn-success">Назад к списку</a></p>
        <p><a href="{{ route('packingsizecatalog.edit', ['size' => $size]) }}" class="btn btn-primary">Изменить</a></p>
        <form action="{{ route('packingsizecatalog.destroy', ['size' => $size]) }}" method="post">
            @csrf
            {{ method_field('delete') }}
            <button onclick="return confirm('Вы подтверждаете удаление?');" type="submit" class="btn btn-danger">Удалить</button>
        </form>
        <div class="table">
            <table class="table table-hover table-stripped">
                <thead>
                <tr>
                    <th>Размер</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $size->size }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
