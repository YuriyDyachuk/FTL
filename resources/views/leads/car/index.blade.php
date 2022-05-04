@extends('page')

@section('title', 'FTL: Авто Сделки')
@section('content_header')
    Авто Сделки @include('partials.title', ['text' => App\Title::get()['leadIndex']['lead']])
@stop

@section('content')
    <div class="row">
        <div class="kt-portlet__body">
            @permission('lead_create')
                <a role="button" class="btn btn-success mb-3 ml-3" href="{{route('leads.car.create')}}">Создать Авто Сделку</a>
            @endpermission
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
{{--            @include('leads._filter')--}}
        </div>
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-borderes leads_table">
                    <thead>
                    <tr>
                        <th>@sortablelink('id', 'Индекс сделки')</th>
                        <th>Клиенты</th>
                        <th>@sortablelink('created_at', 'Дата добавления')</th>
                        <th>@sortablelink('ktkPrefix', 'КТК префикс')</th>
                        <th>@sortablelink('ktkNumber', 'КТК номер')</th>
{{--                        <th>@sortablelink('status', 'Статус')</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leads as $lead)
                        <tr onclick="location.href ='{{route('leads.car.edit', ['lead' => $lead])}}'">
                            <td>{{ $lead->id }}</td>
                            <td>{{ $lead->getClientsNames() }}</td>
                            <td>{{ $lead->created_at }}</td>
                            <td>{{ optional(optional($lead->clientRequest)->ftlWhFrom)->unl_cont_ktk_prefix }}</td>
                            <td>{{ optional(optional($lead->clientRequest)->ftlWhFrom)->unl_cont_ktk_number }}</td>
{{--                            <td class="lead_index_td {{App\Models\Entities\EntityStatus::getStatusColor($lead->status)}}">{{ App\Models\Entities\EntityStatus::getStatusLabels()[$lead->status] }}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $leads ? $leads->appends(\Request::except('page'))->render() : '' !!}
        </div>
    </div>
@stop

{{--@section('js')--}}
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $('.table').DataTable({--}}
{{--                order: [2, 'desc']--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@stop--}}
