<tr>
    <td></td>
    <th>Отчет. Приём</th>
    @foreach($period as $dt)
        @if($order->dateTimeBlock->date == $dt->format('d.m.Y'))
            <td>
                <a data-id="{{$order->whGettingReport->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order->whGettingReport) }} table_form_link clientrequest_th_block open_whgetting_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
