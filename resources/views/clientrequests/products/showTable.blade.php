{{--@if($client->products()->exists())--}}
{{--<h3>Груз</h3>--}}
{{--<table class="table table-striped table-hovered">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Название</th>--}}
{{--        <th>Масса, кг</th>--}}
{{--        <th>Объём, м3</th>--}}
{{--        <th>Тип загрузки1</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($client->products as $product)--}}
{{--        <tr>--}}
{{--            <td>{{ $product->name }}</td>--}}
{{--            <td>{{ $product->weight }}</td>--}}
{{--            <td>{{ $product->volume }}</td>--}}
{{--            <td>--}}
{{--                {{ 'Размер паллет при погрузке: ' . $product->pallet_size . ', кол-во: ' . $product->amount . '.<br>' }}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--@endif--}}
