@extends('page')

@section('title', 'FTL: Роли')

@section('content_header')
    Роли
@stop

@section('content')
    <div class="row">
        <div class="kt-portlet__body">
            <a class="btn btn-success mb-3" href="{{route('roles.create')}}">Добавить</a>
        </div>
    </div>

    <div class="">
        <div class="kt-portlet__body">
            <div class="col-md-12">
                <div class="">
                    <table class="table table-hover table-striped roles_table">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', ['role' => $role]) }}"><i class="fas fa-pen" aria-hidden="true"></i></a>
                                    <form action="{{ route('roles.destroy', ['role' => $role]) }}" method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" onclick="return confirm('Вы подтверждаете удаление?')"><i class="fas fa-trash" aria-hidden="true"></i></button>
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
