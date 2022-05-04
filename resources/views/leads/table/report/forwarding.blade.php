<tr>
    <td></td>
    <th>Доп Услуги</th>
    @foreach($period as $dt)
        @if($order->dateTimeBlock->date == $dt->format('d.m.Y'))
            <td>
                <a data-id="{{$order->forwardingReport->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order->forwardingReport) }} table_form_link clientrequest_th_block open_forwarding_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
