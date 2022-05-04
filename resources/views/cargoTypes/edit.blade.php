@extends('page')

@section('title', 'FTL: тип Груза ' . $model->name)

@section('content_header')
    Тип Груза {{ $model->name }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('cargotypes.update', ['cargotype' => $model])}}" method="post">
                    @csrf
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col-md-12">
                            @include('cargoTypes._form')
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               @include('cargoTypes.destroy')
            </div>
        </div>
    </div>
@stop
