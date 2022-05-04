@extends('page')

@section('title', 'FTL: ЖД Клиентские Заявки')

@section('content_header')
    ЖД Клиентские Заявки @include('partials.title', ['text' => App\Title::get()['ordersIndex']['clientRequest']])
@stop

@section('content')
    <div class="">
        <div class="kt-portlet__body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        @include('clientrequests.tr._filter')
                    </div>
                    <div class="col-md-10">
                        <div class="">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>@sortablelink('leadId', 'Индекс сделки')</th>
                                    <th>@sortablelink('created_at', 'Дата добавления')</th>
                                    <th>@sortablelink('clientName', 'Клиент')</th>
                                    <th>@sortablelink('status', 'Статус')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($entities as $entity)
                                    <tr onclick="location.href ='{{route('clientrequests.tr.edit', ['client' => $entity])}}'">
                                        <td>{{ $entity->lead->id }}</td>
                                        <td>{{ $entity->created_at }}</td>
                                        <td>{{ optional($entity->lead->client)['name'] }}</td>
                                        <td class="@php echo \App\Models\Entities\EntityStatus::getStatusColor($entity->status); @endphp"><span class="d-none">{{$entity->status}}</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(!empty($entities))
                    {!! $entities->appends(\Request::except('page'))->render() !!}
                @endif
            </div>
        </div>
    </div>
@stop

{{--@section('js')--}}
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $('.table').DataTable({--}}
{{--                order: [1, 'desc']--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@stop--}}
