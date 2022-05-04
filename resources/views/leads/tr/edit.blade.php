@extends('page')

@section('title', 'FTL: Сделка № ' . $lead->id)

@section('content_header')
    Сделка № {{ $lead->id }}
@stop

@push('head')
    <script src="{{asset('js/leads/tr.js')}}"></script>
@endpush

@section('content')
    @include('errors')
    <div class="container-fluid">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <ul class="no-pl no_lst">
                        <li>Индекс сделки - {{ $lead->id }}</li>
                        <li>Дата сделки - {{ $lead->created_at->format('d.m.Y') }}</li>
                        <li>Клиенты - {{ $lead->getClientsNames() }}</li>
                        <li>ИНН {{ $lead->getClientsInns() }}</li>
                        <li>Пункт А - {{ optional(optional(optional($lead->clientRequest)->clientRequestFroms())->first())->city }}</li>
                        <li>Пункт Б - {{ optional(optional(optional($lead->clientRequest)->clientRequestTos())->first())->city }}</li>
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="row">

{{--                <div class="pl-3">@include('partials.manageStatuses', ['lead' => $lead, 'viewAll' => true, 'model' => $lead])</div>--}}

                {{--                <p>Статус - <span class="{{App\Models\Entities\EntityStatus::getStatusColor($lead->status)}} status_span">{{ App\Models\Entities\EntityStatus::getStatusLabels()[$lead->status] }}</span></p>--}}
                <div class="w-100"></div>
                <h4 class="pl-3" style="display: initial;margin: 10px 0;">Ответственный Менеджер Сделки - {{ optional($lead->responsibleUser)->name }}</h4> @include('partials.title', ['text' => App\Title::get()['lead']['responsibleManager']])
                <div class="w-100"></div>
                @if($lead->responsible_user_id == $userManager->getId())
                    <form class="col-md-3" id="updateleadform" action="{{route('leads.tr.update', ['lead' => $lead])}}" method="post" >
                        @csrf
                        {{ method_field('put') }}
                        <input type="hidden" name="lead[status]" value="{{ $lead->status }}" class="status_field">
                        <input type="hidden" name="lead[id]" value="{{ $lead->id }}">
                        <div class="form-group">
                            <label class="control-label">Клиенты</label>
                            <select name="lead[client_id][]" class="form-control clientids-select" multiple>
                                <option value=""></option>
                                @foreach(\App\Models\Helpers\ClientsHelper::getList() as $id => $name)
                                    <option {{ in_array($id, $lead->getClientsIds()) ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                @endif
                <div class="w-100"></div>
                @if($userManager->can('lead_delete') && $userManager->getId() == $lead->responsible_user_id)
                    <div class="form-group mr-1">
                        <form action="{{ route('leads.tr.destroy', ['lead' => $lead]) }}" method="post">
                            @csrf
                            {{ method_field('delete') }}
                            <button onclick="return confirm('Вы подтверждаете удаление?');" type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                @endif

                @if($userManager->can('lead_edit') && $userManager->getId() == $lead->responsible_user_id)
                    <div class="form-group">
                        <a href="#" class="btn btn-success save-form-btn">Сохранить</a>
                    </div>
                @endif
                <div class="col-sm-12 pl0">
                    <h3 style="display: initial;">Календарный План</h3> @include('partials.title', ['text' => App\Title::get()['lead']['calendar']])
                    <div class="table" style="overflow-x: scroll;">
                        <table class="table table-stripped table-bordered leads_calendar_table">
                            <thead>
                            <tr>
                                <th style="padding: 0 160px;"></th>
                                <th style="padding: 0 110px;"></th>
                                @foreach($period as $dt)
                                    <th style="padding: {{ mb_strlen(App\Helpers\DateHelper::getMonthStringFromNumber($dt->format('m'))) == '3' ? '3px 13px' : '5px' }}; text-align: center;">{{ $dt->format('d') . ' ' . App\Helpers\DateHelper::getMonthStringFromNumber($dt->format('m')) }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @include('leads.table.clientRequest', ['lead' => $lead])
                            @if(optional($lead->clientRequest)->status == \App\Models\Entities\EntityStatus::DONE_STATUS && $lead->orders()->exists())
                                @foreach($lead->getOrders() as $order)
                                    @include('leads.table.order', ['order' => $order])
                                    @if($order['status'] != \App\Models\Entities\EntityStatus::NEW_STATUS)
                                        @if($order['name'] == \App\Models\Entities\Order::TR_NAME)
                                            @include('leads.table.report.train')
                                        @endif
                                        @if($order['name'] == \App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME)
                                            @include('leads.table.report.forwarding')
                                        @endif
                                        @if($order['type'] == \App\Models\Entities\Order::CAR_TYPE && $order['name'] !== \App\Models\Entities\Order::CAR_HEAVY_RENT_NAME
                                            || in_array($order['name'], [\App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME, \App\Models\Entities\Order::WH_GETTING_NAME]))
                                            @include('leads.table.report.waybill')
                                        @endif
                                        @if($order['type'] == \App\Models\Entities\Order::CAR_TYPE)
                                            @include('leads.table.report.routeTrack')
                                        @endif
                                        @if($order['name'] == \App\Models\Entities\Order::CAR_HEAVY_RENT_NAME)
                                            @include('leads.table.report.heavyrent')
                                        @endif
                                        @if($order['name'] == \App\Models\Entities\Order::WH_GETTING_NAME)
                                            @include('leads.table.report.cargo')
                                            @include('leads.table.report.whgetting')
                                        @endif
                                        @if($order->driverBlock()->exists() && in_array($order['type'], [\App\Models\Entities\Order::CAR_TYPE, \App\Models\Entities\Order::WH_TYPE]))
                                            @include('leads.table.report.driver')
                                        @endif
                                        @if($order['name'] == \App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME)
                                            @include('leads.table.report.ktkdownl')
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('report.train.modal')
        @include('report.forwarding.modal')
        @include('report.carpoint.modal')
        @include('report.waybill.modal')
        @include('report.routetrack.modal')
        @include('report.heavyrent.modal')
        @include('report.cargo.modal')
        @include('report.driver.modal')
        @include('report.whgetting.modal')
        @include('report.ktkdownl.modal')
    </div>
@stop


