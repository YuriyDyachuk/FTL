<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>Добавить</th>
        <th>Груз</th>
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
            <td>
                <label class="kt-checkbox">
                    <input class="cargos_checkbox" value="{{ $cargo->uid }}" name="cargos[]" type="checkbox">
                    <span></span>
                </label>
            </td>
            <td>{{ $cargo->name }}</td>
            <td>{{ $cargo->getStatusLabel() }}</td>
            <td>{{ $cargo->weight }}</td>
            <td>{{ $cargo->volume }}</td>
            <td>{{ $cargo->download_type == 'pallet' ? 'Паллет' : 'Навал' }}</td>
            <td>{{ $cargo->pallet_size }}</td>
            <td>{{ $cargo->amount }}</td>
        </tr>
    </tbody>
</table>
