<tr>
    <td></td>
    <th>Авто Отчет</th>
    @foreach($period as $dt)
        @if($report = $order->getCarReportByDate($dt->format('d.m.Y')))
            <td>
                <a data-id="{{$report->id}}" class="{{ \App\Models\Entities\EntityStatus::getStatusColorForCalendar($report) }} table_form_link clientrequest_th_block open_car_report" href="#">+</a>
            </td>
        @else
            <td></td>
        @endif
    @endforeach
</tr>
