<h3>Принадлежит сделке № {{ $model->lead->id }}</h3>
<a href="{{ route('leads.edit', ['lead' => $model->lead]) }}">Перейти к сделке</a>
@if($model->lead->clientRequest && $model->lead->clientRequest->products()->exists())
    <h3>ТМЦ</h3>
    <table class="table table-striped table-hovered">
        <thead>
        <tr>
            <th>Груз</th>
            <th>Масса, кг</th>
            <th>Объём, м3</th>
            <th>Тип загрузки</th>
        </tr>
        </thead>
        <tbody>
        @foreach($model->lead->clientRequest->products as $product)
            <tr>
                <td>{{ $product->cargo }}</td>
                <td>{{ $product->weight }}</td>
                <td>{{ $product->volume }}</td>
                <td>
                    {{ 'Размер паллет при погрузке: ' . $product->pallet_size . ', кол-во: ' . $product->amount . '.<br>' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
