<tr>
    <td></td>
    <th>{{$order['type'] == $order::CAR_TYPE ? 'Подписанный путевой лист' : 'Накладная'}}</th>
    @php
        $dateTimeBlock = $order['type'] == $order::CAR_TYPE ? $order->lastCarPoint->dateTimeBlock : $order->dateTimeBlock;
    @endphp
    @foreach($period as $dt)
        @if($dateTimeBlock->date == $dt->format('d.m.Y'))
            <td>
                <a data-id="{{$order->waybillReport->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order->waybillReport) }} table_form_link clientrequest_th_block open_waybill_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
