@extends('page')

@section('title', 'FTL: Заявка ' . $order->index)

@section('content_header')
    Заявка {{ $order->index }}
@stop

@push('head')
    <script src="{{asset('js/order.js')}}"></script>
    @if($order->isSingle())
        <script src="{{asset('js/order_single.js')}}"></script>
    @endif
@endpush

@section('content')
@include('errors')
@if($order->userCanChat($userManager ))
    @include('messages.conversations', ['messages' => $messages])
@endif
<div class="container-fluid">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-12 mt-2 mb-2">
                @if($order->isSingle())
                    @include('warehousecargo.modal')
                    <a data-id="{{ $order->id }}" class="btn btn-primary bind_to_lead" href="#">Привязать к Сделке</a>
                @endif
                @if($userManager->getId() == $order['active_responsible_user_id'])
                    @include('widgets.order-notes.order_notes_buttons', ['model' => $order, 'novalidate' => true])
                @endif
                @if($order->name == $order::WH_GETTING_NAME && !empty($order->prFtlOrder()))
                    <a class="btn btn-primary" href="{{route('order.edit', ['order' => $order->prFtlOrder()])}}">Перейти в заявку Поставщик - ФТЛ</a>
                @elseif($order->name == $order::CAR_PROVIDER_FTL_NAME && !empty($order->whGtOrder))
                    <a class="btn btn-primary" href="{{route('order.edit', ['order' => $order->whGtOrder])}}">Перейти в заявку Склад Прием</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('order.validateandsave')}}" method="post" class="main_block_form">
                    <input type="hidden" name="status" value="{{$order->status}}" class="status_field">
                    @include('partials.manageStatuses', ['lead' => $order->lead, 'model' => $order])
{{--                    @csrf--}}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $order->id }}">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Менеджер Сделки</label>
                        <div class="col-lg-1 hint"></div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" disabled value="{{ optional($order->lead->responsibleUser)->name }}">
                        </div>
                    </div>

                    @switch($order->type)
                        @case(\App\Models\Entities\Order::CAR_TYPE)
                            @include('order.responsibles.car')
                            @break
                        @case(\App\Models\Entities\Order::WH_TYPE)
                            @include('order.responsibles.wh')
                            @break
                        @case(\App\Models\Entities\Order::TR_TYPE)
                            @include('order.responsibles.tr')
                            @break
                    @endswitch

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Активно Ответственный</label>
                        <div class="col-lg-1 hint">
                            @include('partials.title', ['text' => App\Title::get()['orderActiveResponsible']])
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" disabled value="{{ optional($order->activeResponsibleUser)->name }}">
                        </div>
                    </div>

                    <input type="hidden" name="responsible_chief_id" value="{{$order['responsible_chief_id']}}">
                    <input type="hidden" name="responsible_branch_chief_id" value="{{$order['responsible_branch_chief_id']}}">

                    <div class="form-group">
                        <textarea name="notes" class="form-control" placeholder="Примечания" id="" cols="30" rows="10">{{$order->notes}}</textarea>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                @if($order->dateTimeBlock()->exists())
                    @include('block.dateTime', ['model' => $order->dateTimeBlock])
                @endif
            </div>
        </div>
        <div class="row">
{{--            {{ dd($orderBlocks->getPoints()) }}--}}
            @if(count($orderBlocks->getPoints()) > 0)
                <div class="under_line"></div>
                @foreach($orderBlocks->getPoints() as $n => $orderPoints)
                    <div class="blocks-{{count($orderBlocks->getPoints())}} col-sm-{{\App\Models\Entities\Block::getBlockWidthByCount(count($orderBlocks->getPoints()))}} {{ $n !== 0 ? 'order_step_block' : '' }}">
                        @foreach($orderPoints as $orderPoint)
                            @include('block.'.$orderPoint->blockTitle(), ['model' => $orderPoint])
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
        @if(!$order->isSingle())
            @if($order->lead->goods()->exists() && in_array($order->name, [App\Models\Entities\Order::CAR_PROVIDER_FTL_NAME, App\Models\Entities\Order::CAR_TM_FTL_TR_NAME, App\Models\Entities\Order::CAR_TM_PROVIDER_TR_NAME, App\Models\Entities\Order::WH_GETTING_NAME, App\Models\Entities\Order::CAR_PROVIDER_CLIENT_NAME]))
                <div class="row">
                    <div class="col-md-12">
                        <div class="order_products_from">
                            @can('edit-goods', $order)
                                @include('order.products.form', ['model' => $order, 'goods' => $order->getAllOrderGoods()])
                            @else
                                @include('order.products.show', ['model' => $order, 'goods' => $order->getCurrentOrderGoods()])
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @else
            @can('edit-goods', $order)
                <form class="block_form goods_form" action="{{route('order.validategoods')}}" method="post">
                    {{ method_field('put') }}
                    <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::SINGLE_ORDER_PRODUCTS}}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    @include('order.single.products.form', ['goods' => $order->goods])
                </form>
            @else
                @include('order.products.show', ['model' => $order, 'goods' => $order->getCurrentOrderGoods()])
            @endif

            @can('single-report', $order)
                <div class="col-md-12">
                    <h2>Ответ на Заявку</h2>
                    @include('order.single.report', ['model' => $order->gettingAct])
                </div>
            @endif
        @endif

        <div class="row mt-5">
                @if($order->driverBlock()->exists() && $order['status'] == \App\Models\Entities\EntityStatus::NEW_STATUS)
                    <div class="col-md-5 pl-0">
                        @include('block.driver', ['model' => $order->driverBlock])
                    </div>
                @endif

            @if(in_array($order['status'], [\App\Models\Entities\EntityStatus::NEW_STATUS, \App\Models\Entities\EntityStatus::IN_PROCESS_STATUS])
                && $order['name'] == \App\Models\Entities\Order::WH_GETTING_NAME
                && $order->isOldest()
                )
                <div class="col-md-7">
                    @include('report.driver.show', ['model' => $order->getDriverReportForWhGettingOrder()])
                </div>
            @endif
        </div>

        @if($order->specCondsBlock()->exists() && $order->canReport($userManager->getId()))
            <div class="row">
                <div class="col-md-4">
                    @include('block.specConds', ['model' => $order->specCondsBlock])
                </div>
            </div>
        @endif

        @if($order->name == $order::WH_KTK_DOWNLOADING_NAME)
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="clrqst_forwarding_block">
                        @include('partials.clientrequest.forwarding', [
                        'forwarding' => $order->lead->clientRequest->forwardingRelation()->exists() ?
                        $order->lead->clientRequest->forwardingRelation : new \App\Models\Entities\Forwarding(),
                        'model' => "clientrequest",
                        'noEdit' => true
                        ]
                        )
                    </div>
                </div>
            </div>
        @endif
        @if($order->powerOfAttorneyReport()->exists() && $order->canReport($userManager->getId()))
            <div class="col-md-3">
                <h3>Отчет. Доверенность</h3>
                @include('report.powerofattorney.form', ['model' => $order->powerOfAttorneyReport])
            </div>
        @endif
        <div class="row">
            @widget('orderNotes', ['model' => $order])
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('partials.backbuttons.index')
            </div>
        </div>
    </div>
</div>
@stop
