<div class="form-group">
    <label class="control-label">Название</label>
    <input value="{{ $model['name'] }}" class="form-control" type="text" name="name">
</div>
<div class="form-group">
    <label class="control-label">Масса, кг</label>
    <input value="{{ $model['weight'] }}" class="form-control" type="text" name="weight">
</div>
<div class="form-group">
    <label class="control-label">Объём, м3</label>
    <input value="{{ $model['volume'] }}" class="form-control" type="text" name="volume">
</div>

<div class="form-group">
    <label class="control-label">Тип Загрузки</label>
    <select class="form-control download_type_select" name="download_type">
        <option {{ $model['download_type'] == 'pallet' ? 'selected' : '' }} value="pallet">Паллет</option>
        <option {{ $model['download_type'] == 'naval' ? 'selected' : '' }} value="naval">Навал</option>
    </select>
</div>

<div class="form-group">
    <label class="control-label">Размер Паллет</label>
    <select class="form-control" name="pallet_size">
        <option value=""></option>
        <option {{ $model['pallet_size'] == '1200*80*1600' ? 'selected' : '' }} value="1200*80*1600">1200*80*1600</option>
        <option {{ $model['pallet_size'] == '1200*80*1800' ? 'selected' : '' }} value="1200*80*1800">1200*80*1800</option>
        <option {{ $model['pallet_size'] == '1200*80*20' ? 'selected' : '' }} value="1200*80*20">1200*80*20</option>
    </select>
</div>

<div class="form-group">
    <label class="control-label">Кол-во</label>
    <input value="{{ $model['amount'] }}" type="text" class="form-control" name="amount">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">Сохранить</button>
</div>
