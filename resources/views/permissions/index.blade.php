@extends('page')

@section('title', 'FTL: Разрешения')

@section('content_header')
    Разрешения
@stop

@section('content')
    <div class="row">
        <div class="kt-portlet__body">
            <a class="btn btn-success mb20" href="{{route('permissions.create')}}">Добавить</a>
        </div>
    </div>
    <div class="">
        <div class="kt-portlet__body">
            <div class="col-md-12">
                <div class="">
                    <table class="table table-hover table-striped permissions_table">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Группа</th>
                            <th>Описание</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->getGroupName() }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', ['permission' => $permission]) }}"><i class="fas fa-pen" aria-hidden="true"></i></a>
                                    <form action="{{ route('permissions.destroy', ['permission' => $permission]) }}" method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" onclick="return confirm('Вы подтверждаете удаление?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('.table').DataTable();
        });
    </script>
@stop
