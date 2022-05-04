<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>Груз</th>
        <th>Клиент</th>
        <th>Статус</th>
        <th>Масса, кг</th>
        <th>Объём, м3</th>
        <th>Тип Загрузки</th>
        <th>Размер Паллет</th>
        <th>Кол-во</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $goodsItem->name }}</td>
            <td>{{ $goodsItem->client->name }}</td>
            <td>{{ $goodsItem->statusLabel }}</td>
            <td>{{ $goodsItem->weight }}</td>
            <td>{{ $goodsItem->volume }}</td>
            <td>{{ $goodsItem->downloadTypeLabel }}</td>
            <td>{{ $goodsItem->pallet_size }}</td>
            <td>{{ $goodsItem->amount }}</td>
        </tr>
    </tbody>
</table>
