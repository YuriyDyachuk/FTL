@extends('page')

@section('title', 'FTL: Пользователи')

@section('content_header')
    Пользователи
@stop

@section('content')
    <div class="row">
        <div class="kt-portlet__body">
            <a class="btn btn-success" href="{{route('users.create')}}">Добавить</a>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__body">

            <div class="" style="margin-top: 20px;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <table class="table table-hover table-striped users_table">
                                <thead>
                                <tr>
                                    <th>ФИО</th>
                                    <th>Email</th>
                                    <th>Добавлено</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', ['user' => $user]) }}"><i class="fas fa-pen" aria-hidden="true"></i></a>
                                            <form action="{{ route('users.destroy', ['user' => $user]) }}" method="post">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button type="submit" onclick="return confirm('Вы подтверждаете удаление?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

