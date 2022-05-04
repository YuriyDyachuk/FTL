@if($order->carPointReports()->exists())
    @foreach($order->carPointReports as $point)
        <tr>
            <td></td>
            <th>{{ $point::typeLabels()[$point['type']] }}</th>
            @foreach($period as $dt)
                @php
                    $carPoint = $point['type'] == $point::FIRST_POINT_TYPE ? $order->firstCarPoint : $order->lastCarPoint;
                @endphp
                @if($carPoint->dateTimeBlock->date == $dt->format('d.m.Y'))
                    <td>
                        <a data-id="{{$point->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($point) }} table_form_link clientrequest_th_block open_carpoint_report" href="#">+</a>
                    </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
    @endforeach
@endif
