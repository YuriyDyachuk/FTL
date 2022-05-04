<div class="form-group row">
    <label class="col-lg-4 col-form-label">Размер</label>
    <div class="col-lg-8">
        <select class="form-control car_size_select" name="{{$modelName}}[unl_cont_ktk_type]">
            <option value=""></option>
            @foreach(App\Models\Entities\KtkTypeCatalog::ktkTypes() as $type)
                <option {{isset($model['unl_cont_ktk_type']) && $model['unl_cont_ktk_type'] == $type ? 'selected' : ''}} value="{{$type}}">{{$type}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group d-none car_spoiler_group">
    <label class="control-label">Погрузка в Машину</label>
    <table class="table table-hover table-striped ktk_spoiler_table">
        <thead>
        <tr>
            <th>Размер</th>
            <th>Объём</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="weight_td">
                {{ $model['unl_cont_ktk_weight'] }}
                <input name="{{$modelName}}[unl_cont_ktk_weight]" type="text" value="{{ $model['unl_cont_ktk_weight'] }}" data-weight="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['weight'] : 0 }}" data-volume="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['volume'] : 0 }}" class="car-slider-weight">
            </td>
            <td class="volume_td">
                {{ $model['unl_cont_ktk_volume'] }}
                <input name="{{$modelName}}[unl_cont_ktk_volume]" type="text" value="{{ $model['unl_cont_ktk_volume'] }}" data-weight="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['weight'] : 0 }}" data-volume="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['volume'] : 0 }}" class="car-slider-volume">
            </td>
        </tr>
        </tbody>
    </table>
</div>
