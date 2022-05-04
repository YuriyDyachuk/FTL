<div class="form-group row">
    <label class="col-lg-4 col-form-label">Наименование</label>
    <div class="col-lg-8">
        <input autocomplete="new-password" value="{{$model['tr_name']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][{{$n}}][tr_name]">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Код</label>
    <div class="col-lg-8">
        <input autocomplete="new-password" value="{{$model['tr_code']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][{{$n}}][tr_code]">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Адрес</label>
    <div class="col-lg-8">
        <input autocomplete="new-password" value="{{$model['tr_address']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][{{$n}}][tr_address]">
    </div>
</div>
