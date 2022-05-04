<table class="table table-hover table-bordered table-striped">
    <tbody>
    <tr>
        <th>Полиэтиленовая плёнка</th>
        <td>{{ $model['plastic_film'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Пенопласт 1200*2400*40</th>
        <td>{{ $model['styrofoam'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Оргалит 1200*2400</th>
        <td>{{ $model['hardboard'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>ОSB 2500*1250*9</th>
        <td>{{ $model['osb'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Картон 1200*2200+</th>
        <td>{{ $model['cardboard'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Стрейч плёнка</th>
        <td>{{ $model['streych_film'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Обрешётка</th>
        <td>{{ $model['crate'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Поддон EUR</th>
        <td>{{ $model['evr_pallet'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Пересчёт количество мест</th>
        <td>{{ $model['places_recalc'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Задание экспедитору</th>
        <td>{{ $model['forwarder_task'] }}</td>
    </tr>
    <tr>
        <th>Размер палет при прогрузке</th>
        <td>{{ $model['pallet_size'] }}</td>
    </tr>
    <tr>
        <th>Утепление</th>
        <td>{{ $model['warming'] }}</td>
    </tr>
    <tr>
        <th>Загрузка навал</th>
        <td>{{ $model['naval_downloading'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Загрузка на паллетах</th>
        <td>{{ $model['downloading_on_pallet'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Загрузка негабарит</th>
        <td>{{ $model['oversize_downloading'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Пересчёт внутри тарных вложений</th>
        <td>{{ $model['inside_recalc'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Стикировка</th>
        <td>{{ $model['stickering'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Пломбирование места</th>
        <td>{{ $model['place_filling'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Пломбирование фургона</th>
        <td>{{ $model['van_filling'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Формирование паллет</th>
        <td>{{ $model['pallet_formation'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Формирование ассортимента по параметрам</th>
        <td>{{ $model['parameters_formation'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Фиксация вязальной проволокой</th>
        <td>{{ $model['knitting_wire_fixation'] ? '+' : '-' }}</td>
    </tr>
    <tr>
        <th>Консолидация</th>
        <td>{{ $model['consolidation'] }}</td>
    </tr>
    <tr>
        <th>Фото фискация</th>
        <td>{{ $model['photofix_enabled'] ? '+' : '-' }}</td>
    </tr>
    @if($model['photofix_enabled'] == '1')
        <tr>
            <th>Дата фотофиксации</th>
            <td>{{ $model['photofix_date'] }}</td>
        </tr>
    @endif
    </tbody>
</table>
