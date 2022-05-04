<tr>
    <td></td>
    <th>Отчет. КТК</th>
    @foreach($period as $dt)
        @if($order->dateTimeBlock->date == $dt->format('d.m.Y'))
            <td>
                <a data-lead="{{ $order->lead->id }}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($order) }} table_form_link clientrequest_th_block open_ktkdownl_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
