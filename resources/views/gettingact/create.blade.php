@extends('page')

@section('title', 'FTL: Акт приема')

{{--@section('content_header')--}}
{{--    Акт приема--}}
{{--@stop--}}

@section('content')
<div class="container-fluid">
    <form action="{{route('gettingact.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <h3>Акт приема</h3>
                @include('gettingact._form', ['model' => new \App\Models\Entities\GettingAct()])
            </div>
            <div class="col-md-4">
                <h3>Водитель</h3>
                @include('gettingact.report.driver')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('gettingact.cargo', ['model' => new \App\Models\Entities\GettingAct()])
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
@stop
