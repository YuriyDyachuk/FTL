<table class="table table-hover table-striped export_spoiler_table">
    <thead>
    <tr>
        <th>Акт приема №</th>
        <th>Масса, кг</th>
        <th>Объём, м3</th>
        <th>Кол-во</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            @if(!empty($cargo->getting_acts))
                @foreach(array_column(json_decode($cargo->getting_acts), 'getting_act_id') as $id)
                    <a target="_blank" href="{{ route('gettingact.edit', $id) }}">{{ $id }}</a>
                    <br>
                @endforeach
            @endif
        <td class="weight_td">
            {{ $cargo->getWeight() }}
            <input name="{{ 'export['.$cargo->id.'][weight]' }}" type="text" value="{{ $cargo->getWeight() }}" data-amount="{{ $cargo->amount }}" data-weight="{{ $cargo->getWeight() }}" data-volume="{{ $cargo->getVolume() }}" class="slider-weight">
        </td>
        <td class="volume_td">
            {{ $cargo->getVolume() }}
            <input name="{{ 'export['.$cargo->id.'][volume]' }}" type="text" value="{{ $cargo->getVolume() }}" data-amount="{{ $cargo->amount }}" data-weight="{{ $cargo->getWeight() }}" data-volume="{{ $cargo->getVolume() }}" class="slider-volume">
        </td>
        <td>
            {{ $cargo->amount }}
            <input name="{{ 'export['.$cargo->id.'][amount]' }}" type="text" value="{{ $cargo->amount }}" data-amount="{{ $cargo->amount }}" data-weight="{{ $cargo->getWeight() }}" data-volume="{{ $cargo->getVolume() }}" class="slider-amount">
        </td>
    </tr>
    </tbody>
</table>
