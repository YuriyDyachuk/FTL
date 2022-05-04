@extends('page')

@section('title', 'FTL: Изменить роль')

@section('content_header')
    Изменить роль: {{ $role->display_name }}
@stop

@section('content')
    <div class="kt-portlet__body">
        <div class="col-md-4">
            @include('errors')
            <form action="{{ route('roles.update', ['role' => $role]) }}" method="post">
                @csrf
                {{ method_field('put') }}
                <div class="form-group">
                    <label class="control-label">Название</label>
                    <input class="form-control" type="text" name="display_name" value="{{ old('display_name') ?: $role->display_name }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Слаг</label>
                    <input readonly class="form-control" type="text" name="name" value="{{ old('name') ?: $role->name }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Описание</label>
                    <textarea class="form-control" type="text" name="description">{{ old('description') ?: $role->description }}</textarea>
                </div>
                <div class="">
                    <h2>Разрешения</h2>
                    @foreach($permissions as $permissionGroup)
                        <h4>{{$permissionGroup[0]->getGroupName()}}:</h4>
                        @foreach($permissionGroup as $permission)
                            <label class="control-label"><input {{ $role->hasPermission($permission->name) ? 'checked' : '' }} name="permissions[]" type="checkbox" value="{{$permission->id}}">{{$permission->display_name}}</label>
                            <br>
                        @endforeach
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@stop
