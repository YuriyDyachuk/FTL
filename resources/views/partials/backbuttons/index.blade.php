@switch($order->type)
    @case(\App\Models\Entities\Order::CAR_TYPE)
        @include('partials.backbuttons.car', ['model' => $order])
        @break
    @case(\App\Models\Entities\Order::TR_TYPE)
        @include('partials.backbuttons.tr', ['model' => $order])
        @break
    @case(\App\Models\Entities\Order::WH_TYPE)
        @include('partials.backbuttons.wh', ['model' => $order])
        @break
@endswitch
