@extends('page')

@section('title', 'FTL: Изменить пользователя')

@section('content_header')
    Изменить пользователя
@stop

@section('content')
    <div class="kt-portlet__body">
        <div class="col-md-4">
            @include('errors')
            <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                @csrf
                {{ method_field('put') }}
                <div class="form-group">
                    <label class="control-label">ФИО</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') ?: $user->name }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="text" name="email" value="{{ old('email') ?: $user->email }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Пароль</label>
                    <input class="form-control" type="text" name="password">
                </div>
                <h2>Роли:</h2>
                @foreach($roles as $role)
                    <label class="control-label"><input name="roles[]" {{ $user->hasRole($role->name) ? 'checked' : '' }} value="{{ $role->id }}" type="checkbox">{{ $role->display_name }}</label><br>
                @endforeach
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@stop
