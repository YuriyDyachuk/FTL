<div class="form-block row">
    <label class="col-lg-4 col-form-label">Наименование Терминала</label>
    <div class="col-lg-8">
        <input value="{{$model['tm_name'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[tm_name]">
    </div>
</div>

<div class="form-block row">
    <label class="col-lg-4 col-form-label">Код</label>
    <div class="col-lg-8">
        <input value="{{$model['tm_code'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[tm_code]">
    </div>
</div>

<div class="form-block row">
    <label class="col-lg-4 col-form-label">Город</label>
    <div class="col-lg-8">
        <input value="{{$model['tm_city'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[tm_city]">
    </div>
</div>

<div class="form-block row">
    <label class="col-lg-4 col-form-label">Адрес</label>
    <div class="col-lg-8">
        <input value="{{$model['tm_address'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[tm_address]">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Доверенность №</label>
    <div class="col-lg-8">
        <input value="{{$model['tm_power_of_attorney_number'] ?? ''}}" type="text" class="form-control" name="{{$modelName}}[tm_power_of_attorney_number]">
    </div>
</div>

@if(isset($model['tm_power_of_attorney_scan']) && is_file('storage/images/'.$model['tm_power_of_attorney_scan']))
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-lg-4 col-form-label">Доверенность Скан</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input class="custom-file-input" type="file" name="{{$modelName}}[tm_power_of_attorney_scan_file]">
                        <label class="custom-file-label">Доверенность Скан</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <a class="table_form_link" data-fancybox="gallery"
               href="{{ Storage::url('/images/'.$model['tm_power_of_attorney_scan']) }}">
                <img style="width: 150px;" class="img-responsive" src="/images/document.png" alt="">
            </a>
        </div>
    </div>
@else
    <div class="form-group">
        <label class="col-lg-4 col-form-label">Доверенность Скан</label>
        <div class="col-lg-8">
            <div class="custom-file">
                <input class="custom-file-input" type="file" name="{{$modelName}}[tm_power_of_attorney_scan_file]">
                <label class="custom-file-label">Доверенность Скан</label>
            </div>
        </div>
    </div>
@endif
<input type="hidden" name="{{$modelName}}[tm_power_of_attorney_scan]" value="{{$model['tm_power_of_attorney_scan'] ?? ''}}">
