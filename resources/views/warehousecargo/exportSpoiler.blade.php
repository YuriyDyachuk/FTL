<table class="table table-hover table-striped export_spoiler_table">
    <thead>
    <tr>
        <th>Масса, кг</th>
        <th>Объём, м3</th>
        <th>Кол-во</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="weight_td">
            {{ $goodsItem->weight }}
            <input name="{{ 'export['.$goodsItem->id.'][weight]' }}" type="text" value="{{ $goodsItem->weight }}" data-amount="{{ $goodsItem->amount }}" data-weight="{{ $goodsItem->weight }}" data-volume="{{ $goodsItem->volume }}" class="slider-weight">
        </td>
        <td class="volume_td">
            {{ $goodsItem->volume }}
            <input name="{{ 'export['.$goodsItem->id.'][volume]' }}" type="text" value="{{ $goodsItem->volume }}" data-amount="{{ $goodsItem->amount }}" data-weight="{{ $goodsItem->weight }}" data-volume="{{ $goodsItem->volume }}" class="slider-volume">
        </td>
        <td>
            {{ $goodsItem->amount }}
            <input name="{{ 'export['.$goodsItem->id.'][amount]' }}" type="text" value="{{ $goodsItem->amount }}" data-amount="{{ $goodsItem->amount }}" data-weight="{{ $goodsItem->weight }}" data-volume="{{ $goodsItem->volume }}" class="slider-amount">
        </td>
    </tr>
    </tbody>
</table>
