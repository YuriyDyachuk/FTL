@extends('page')

@section('title', 'FTL: Тип КТК')

@section('content_header')
    Тип КТК - {{ $type->name }}
@stop

@section('content')
    <div class="col-sm-12 pl0">
        <p><a href="{{ route('ktktypecatalog.index') }}" class="btn btn-success">Назад к списку</a></p>
        <p><a href="{{ route('ktktypecatalog.edit', ['type' => $type]) }}" class="btn btn-primary">Изменить тип</a></p>
        <p>
        <form action="{{ route('ktktypecatalog.destroy', ['type' => $type]) }}" method="post">
            @csrf
            {{ method_field('delete') }}
            <button onclick="return confirm('Вы подтверждаете удаление?');" type="submit" class="btn btn-danger">Удалить</button>
        </form>
        </p>
        <div class="table">
            <table class="table table-hover table-stripped">
                <thead>
                <tr>
                    <th>Название</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $type->name }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
