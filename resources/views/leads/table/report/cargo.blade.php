<tr>
    <td></td>
    <th>Отчет. Груз</th>
    @foreach($period as $dt)
        @if($order->dateTimeBlock->date == $dt->format('d.m.Y'))
            <td>
                <a data-id="{{$order->cargoReport->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order->cargoReport) }} table_form_link clientrequest_th_block open_cargo_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
