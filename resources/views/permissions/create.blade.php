@extends('page')

@section('title', 'FTL: Добавить разрешение')

@section('content_header')
    Добавить разрешение
@stop

@section('content')
    <div class="kt-portlet__body">
        <div class="col-md-4">
            @include('errors')
            <form action="{{ route('permissions.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="control-label">Группа</label>
                    <select name="permission_group" class="form-control">
                        <option value=""></option>
                        @foreach(\App\Models\Entities\Permission::getPermissionGroup() as $key => $group)
                            <option value="{{ $key }}">{{ $group }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Название</label>
                    <input class="form-control" type="text" name="display_name" value="{{ old('display_name') }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Слаг</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Описание</label>
                    <textarea class="form-control" type="text" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@stop
