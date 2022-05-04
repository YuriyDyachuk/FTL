<div class="form-block row">
    <label class="col-lg-4 col-form-label">Наименование</label>
    <div class="col-lg-8">
        <input value="{{$model['pickup_name'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[pickup_name]">
    </div>
</div>

<div class="form-block row">
    <label class="col-lg-4 col-form-label">Код</label>
    <div class="col-lg-8">
        <input value="{{$model['pickup_code'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[pickup_code]">
    </div>
</div>

<div class="form-block row">
    <label class="col-lg-4 col-form-label">Город</label>
    <div class="col-lg-8">
        <input value="{{$model['pickup_city'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[pickup_city]">
    </div>
</div>

<div class="form-block row">
    <label class="col-lg-4 col-form-label">Адрес</label>
    <div class="col-lg-8">
        <input value="{{$model['pickup_address'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[pickup_address]">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Доверенность №</label>
    <div class="col-lg-8">
        <input value="{{$model['pickup_power_of_attorney_number'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[pickup_power_of_attorney_number]">
    </div>
</div>

<div class="form-block row">
    <label class="col-lg-4 col-form-label">Доверенность Скан</label>
    <div class="col-lg-8">
        <div class="custom-file">
            <input class="custom-file-input" type="file" name="{{$modelName}}[pickup_power_of_attorney_scan_file]">
            <label class="custom-file-label">Доверенность Скан</label>
        </div>
    </div>
</div>
