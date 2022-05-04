<tr>
    <th>
{{--        <p>{{ \App\Models\Entities\Order::orderTypes()[$order->type] }} Заявка</p>--}}
        @if(\App\Models\Permissions\OrderOwnerPermission::check($order, $lead))
            <a href="{{ route('order.edit', ['order' => $order]) }}">{{ \App\Models\Entities\Order::orderNames()[$order->name] }}</a>
        @else
            <a href="#">{{ \App\Models\Entities\Order::orderNames()[$order->name] }}</a>
        @endif
        <span class="order_status_circle {{\App\Models\Entities\EntityStatus::getStatusColor($order->status)}}"></span>
{{--                @if($n == 0)--}}
            @include('partials.title', ['text' => App\Title::get()['firstOrderForm']['orderFormStatuses'], 'class' => 'firstOrderFormTitle'])
{{--                @endif--}}
    </th>
    <th>Создать заявку</th>

    @foreach($period as $dt)
        @if($userManager->can('car_create')
&& $order->created_at
&& \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)
->format('d.m.Y')
        == $dt->format('d.m.Y'))
            <td style="position: relative;">
                @if(\App\Models\Permissions\OrderOwnerPermission::check($order, $lead))
                    <a class="clientrequest_th_block table_form_link {{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order) }}" href="{{ route('order.edit', ['order' => $order]) }}">+</a>
                @else
                    <a class="clientrequest_th_block table_form_link {{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order) }}" href="#">+</a>
                @endif
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>

@if($order->getLeadOrderBlocks()->pointsExists())
    @foreach($order->getLeadOrderBlocks()->getPoints() as $c => $point)
        @foreach($point as $n => $pointItem)
            @if($order['type'] == \App\Models\Entities\Order::CAR_TYPE && $order['name'] != \App\Models\Entities\Order::CAR_HEAVY_RENT_NAME)
                <tr>
                    <td></td>
                    <th>{{ $pointItem->getBlockTitle() }}</th>
                    @foreach($period as $dt)
                        @if($pointItem['date'] === $dt->format('d.m.Y') || optional($pointItem->dateTimeBlock)->date === $dt->format('d.m.Y'))
                            <td>
                                @if($carPoint = $order->getCarPoint(++$c))
                                    <a data-id="{{$carPoint->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($carPoint) }} table_form_link clientrequest_th_block open_carpoint_report" href="#">+</a>
                                @else
                                    <a class="{{ \App\Models\Entities\EntityStatus::getStatusColor($order->status) }} table_form_link clientrequest_th_block" href="#">+</a>
                                @endif
                            </td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                </tr>
            @else
                <tr>
                    <td></td>
                    <th>{{ $pointItem->getBlockTitle() }}</th>
                    @foreach($period as $dt)
                        @if($pointItem['date'] === $dt->format('d.m.Y') || optional($pointItem->dateTimeBlock)->date === $dt->format('d.m.Y'))
                            <td>
                                <a class="{{ \App\Models\Entities\EntityStatus::getStatusColor($order->status) }} table_form_link clientrequest_th_block" href="#">+</a>
                            </td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                </tr>
            @endif

        @endforeach
    @endforeach
@endif
