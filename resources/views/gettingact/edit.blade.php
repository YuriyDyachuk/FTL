@extends('page')

@section('title', 'FTL: Акт приема')

@section('content')
    <div class="container-fluid">
        <form action="{{route('gettingact.update', ['gettingact' => $model])}}" method="post">
            @csrf
            {{ method_field('put') }}
            <div class="row">
                <div class="col-md-4">
                    <h3>Акт приема № {{ $model->id }}</h3>
                    @include('gettingact._form', ['model' => $model])
                </div>
                <div class="col-md-4">
                    <h3>Водитель</h3>
                    @include('gettingact.report.driver')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('gettingact.cargo', ['model' => $model])
                </div>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>

@stop
