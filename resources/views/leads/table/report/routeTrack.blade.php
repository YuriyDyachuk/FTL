<tr>
    <td></td>
    <th>Трек Маршрут</th>
    @php
        $date = $order['name'] == $order::CAR_HEAVY_RENT_NAME ? $order->heavyRentBlock->end_date : $order->firstCarPoint->dateTimeBlock->date;
    @endphp
    @foreach($period as $dt)
        @if($date == $dt->format('d.m.Y'))
            <td>
                <a data-id="{{$order->routeTrackReport->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order->routeTrackReport) }} table_form_link clientrequest_th_block open_routetrack_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>

