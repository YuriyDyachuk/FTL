<tr>
    <td></td>
    <th>Отчет. Перевозчик</th>
    @foreach($period as $dt)
        @if($order->driverBlock->date == $dt->format('d.m.Y'))
            <td>
                <a data-id="{{$order->driverReport->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order->driverReport) }} table_form_link clientrequest_th_block open_driver_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
