@extends('page')

@section('title', 'FTL: Тип КТК')

@section('content_header')
    Тип КТК
@stop

@section('content')
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success mb-3" href="{{route('ktktypecatalog.create')}}">Добавить</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 pl0">
                <h3>Фильтр</h3>
                @include('ktktypecatalog._filter')
            </div>
            <div class="col-sm-10">
                <div class="table">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Просмотр</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td><a href="{{ route('ktktypecatalog.show', ['type' => $type]) }}"><i class="fa fa-eye" aria-hidden="true"></i>
                                    </a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <?php echo $types->render(); ?>
            </div>
        </div>
    </div>


@stop



@section('js')
    <script> console.log('Hi!'); </script>
@stop
