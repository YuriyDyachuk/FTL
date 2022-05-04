@extends('page')

@section('title', 'FTL: Размеры фасовок')

@section('content_header')
    Размеры фасовок
@stop

@section('content')

    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success mb-3" href="{{route('packingsizecatalog.create')}}">Добавить</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <h3>Фильтр</h3>
                @include('packingsizecatalog._filter')
            </div>
            <div class="col-md-10">
                <div class="">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Размер</th>
                            <th>Просмотр</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sizes as $size)
                            <tr>
                                <td>{{ $size->size }}</td>
                                <td><a href="{{ route('packingsizecatalog.show', ['size' => $size]) }}"><i class="fa fa-eye" aria-hidden="true"></i>
                                    </a></td>
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
