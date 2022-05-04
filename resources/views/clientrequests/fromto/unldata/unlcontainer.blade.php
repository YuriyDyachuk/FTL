<div class="cont_block">
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Вид КТК</label>
        <div class="col-lg-8">
            <select name="{{$modelName}}[cont_type]" class="form-control cont_type_select">
                <option value=""></option>
                <option {{isset($model['cont_type']) && $model['cont_type'] == 'Универсальный' ? 'selected' : ''}} value="Универсальный">Универсальный</option>
                <option {{isset($model['cont_type']) && $model['cont_type'] == 'Рефрижератор' ? 'selected' : ''}} value="Рефрижератор">Рефрижератор</option>
            </select>
        </div>
    </div>

    <div class="form-group row temp_mode_block {{ empty($model['cont_type']) ? 'd-none' : '' }}">
        <label class="col-lg-4 col-form-label">Температурный режим</label>
        <div class="col-lg-8">
            <input type="text" name="{{$modelName}}[temp_mode]" value="{{$model['temp_mode'] ?? ''}}" class="form-control">
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Размер контейнера</label>
    <div class="col-lg-8">
        <select class="form-control cont_size_select" name="{{$modelName}}[unl_cont_ktk_type]">
            <option value=""></option>
            @foreach(array_keys(App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()) as $type)
                <option {{isset($model['unl_cont_ktk_type']) && $model['unl_cont_ktk_type'] == $type ? 'selected' : ''}} value="{{$type}}">{{$type}}</option>
            @endforeach
        </select>
    </div>
</div>

{{--@if($lead->isTrainType())--}}
    <div class="form-group d-none ktk_spoiler_group">
        <label class="control-label">Погрузка в КТК</label>
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
                    <input name="{{$modelName}}[unl_cont_ktk_weight]" type="text" value="{{ $model['unl_cont_ktk_weight'] }}" data-weight="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['weight'] : 0 }}" data-volume="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['volume'] : 0 }}" class="ktk-slider-weight">
                </td>
                <td class="volume_td">
                    {{ $model['unl_cont_ktk_volume'] }}
                    <input name="{{$modelName}}[unl_cont_ktk_volume]" type="text" value="{{ $model['unl_cont_ktk_volume'] }}" data-weight="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['weight'] : 0 }}" data-volume="{{ $model['unl_cont_ktk_type'] ? \App\Models\Entities\KtkTypeCatalog::ktkTypesWeightVolume()[$model['unl_cont_ktk_type']]['volume'] : 0 }}" class="ktk-slider-volume">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
{{--@endif--}}
