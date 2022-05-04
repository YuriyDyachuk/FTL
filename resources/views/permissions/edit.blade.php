@extends('page')

@section('title', 'FTL: Изменить разрешение')

@section('content_header')
    Изменить разрешение
@stop

@section('content')
    <div class="kt-portlet__body">
        <div class="col-md-4">
            @include('errors')
            <form action="{{ route('permissions.update', ['permission' => $permission]) }}" method="post">
                @csrf
                {{ method_field('put') }}
                <div class="form-group">
                    <label class="control-label">Группа</label>
                    <select name="permission_group" class="form-control">
                        <option value=""></option>
                        @foreach(\App\Models\Entities\Permission::getPermissionGroup() as $key => $group)
                            <option {{$permission->permission_group == $key ? 'selected' : ''}} value="{{ $key }}">{{ $group }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Название</label>
                    <input class="form-control" type="text" name="display_name" value="{{ old('display_name') ?: $permission->display_name }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Слаг</label>
                    <input readonly class="form-control" type="text" name="name" value="{{ old('name') ?: $permission->name }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Описание</label>
                    <textarea class="form-control" type="text" name="description">{{ old('description') ?: $permission->description }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@stop
