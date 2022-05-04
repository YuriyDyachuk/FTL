<tr>
    <td></td>
    <th>Заказ тяж. техники</th>

    @foreach($period as $dt)
        @if(optional($order->heavyRentBlock)->begin_date == $dt->format('d.m.Y'))
            <td>
                <a data-id="{{$order->heavyRentReport->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order->heavyRentReport) }} table_form_link clientrequest_th_block open_heavyrent_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
