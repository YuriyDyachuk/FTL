@extends('page')

@section('title', 'FTL: Склад Груз')

@section('content_header')
    Склад Груз
@stop

@push('head')
    <script src="{{ asset('js/warehousecargo.js') }}"></script>
@endpush

@section('content')
    @include('partials.warehousecargo.clientRequests.modal')
    <div class="">
        @include('warehousecargo.modal')
        <div class="">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-2">
{{--                        @include('order._filter', ['route' => \Route::getCurrentRoute()->uri])--}}
                    </div>
                    <div class="col-md-10">
                        <a href="#" class="btn btn-success open_cargos_model d-none">Добавление Груза в КЗ Сделки</a>
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Добавить</th>
                                <th>@sortablelink('client_id', 'Клиент')</th>
                                <th>@sortablelink('name', 'Груз')</th>
                                <th>@sortablelink('status', 'Статус')</th>
                                <th>@sortablelink('weight', 'Масса, кг')</th>
                                <th>@sortablelink('volume', 'Объём, м3')</th>
                                <th>@sortablelink('download_type', 'Тип Загрузки')</th>
                                <th>@sortablelink('pallet_size', 'Размер Паллет')</th>
                                <th>@sortablelink('amount', 'Кол-во')</th>
                                <th>Добавлен в КЗ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($goods))
                                @foreach($goods as $goodsItem)
                                    <tr class="cargo_el">
                                        <td class="no_modal">
                                            @if($goodsItem->status !== \App\Models\Entities\GettingActCargo::DONE_STATUS && !$goodsItem->goodsLeads()->exists())
                                                <label class="kt-checkbox">
                                                    <input class="cargos_checkbox" value="{{ $goodsItem->id }}" name="goods[]" type="checkbox">
                                                    <span></span>
                                                </label>
                                            @endif
                                        </td>
                                        <td>{{ $goodsItem->client->name }}</td>
                                        <td>{{ $goodsItem->name }}</td>
                                        <td>{{ $goodsItem->statusLabel }}</td>
                                        <td>{{ $goodsItem->weight }}</td>
                                        <td>{{ $goodsItem->volume }}</td>
                                        <td>{{ $goodsItem->downloadTypeLabel }}</td>
                                        <td>{{ $goodsItem->pallet_size }}</td>
                                        <td>{{ $goodsItem->amount }}</td>
                                        <td class="no_modal">
                                            @if($goodsItem->goodsLeads()->exists())
                                                <a target="_blank" href="{{ route('clientrequests.'.$goodsItem->goodsLeads->lead->getShortLabel().'.edit', $goodsItem->goodsLeads->lead->clientRequest->id) }}">{{ $goodsItem->goodsLeads->lead->clientRequest->id }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
