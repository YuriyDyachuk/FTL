<div class="form-group row">
    <label class="col-lg-4 col-form-label">Дата</label>
    <div class="col-lg-8">
        <input type="text" name="begin_date" value="{{ $model->begin_date }}" class="date_input form-control">
    </div>
</div>

<div class="row interval_row">
    <div class="col-sm-10">
        <div class="row interval_enabled {{ $model->begin_time_interval == '1' ? '' : 'd-none' }}">
            <div class="col-sm-5">
                <label class="control-label">Время</label>
            </div>
            <div class="col-sm-3">
                <div class="form-group row">
                    <label class="col-lg-1 col-form-label pr-1">с</label>
                    <div class="col-lg-9">
                        <input type="text" name="begin_time_from" value="{{ $model->begin_time_from }}" class="time_input form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group row">
                    <label class="col-lg-1 col-form-label pr-1">по</label>
                    <div class="col-lg-9">
                        <input type="text" name="begin_time_to" value="{{ $model->begin_time_to }}" class="time_input form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="interval_disabled {{ $model->begin_time_interval == '1' ? 'd-none' : '' }}">
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Время</label>
                <div class="col-lg-7 offset-md-1" style="padding-left: 6px;">
                    <input type="text" name="begin_time" value="{{ $model->begin_time }}" class="time_input form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2 pl-0 pt-1">
        <div class="kt-checkbox-list">
            <label class="kt-checkbox">
                инт. <input class="interval_toggle" {{ $model->begin_time_interval == '1' ? 'checked' : '' }} name="begin_time_interval" type="checkbox">
                <span></span>
            </label>
        </div>
    </div>
</div>
