{{--<h3>Дата/время</h3>--}}
<div class="row">
    <div class="col-md-12">
        <form method="post" class="block_form">
{{--            @csrf--}}
            {{ method_field('put') }}
            <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::DATE_TIME_TYPE}}">
            <input type="hidden" name="id" value="{{$model->id}}">
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Дата</label>
                <div class="col-lg-8">
                    <input type="text" name="date" value="{{ $model->date }}" class="date_input form-control">
                </div>
            </div>

            <div class="row interval_row">
                <div class="col-sm-12">
                    <div class="row interval_enabled {{ $model->interval == '1' ? '' : 'd-none' }}">
                        <div class="col-sm-5">
                            <label class="control-label">Время</label>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label pr-1">с</label>
                                <div class="col-lg-9">
                                    <input type="text" name="time_from" value="{{ $model->time_from }}" class="time_input form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label pr-1">по</label>
                                <div class="col-lg-9">
                                    <input type="text" name="time_to" value="{{ $model->time_to }}" class="time_input form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="interval_disabled {{ $model->interval == '1' ? 'd-none' : '' }}">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Время</label>
                            <div class="col-lg-6 time_block_header">
                                <input type="text" name="time" value="{{ $model->time }}" class="time_input form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="interval_toggle_checkbox">
                    <div class="kt-checkbox-list">
                        <label class="kt-checkbox">
                            инт.<input class="interval_toggle" {{ $model->interval == '1' ? 'checked' : '' }} name="interval" type="checkbox">
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
