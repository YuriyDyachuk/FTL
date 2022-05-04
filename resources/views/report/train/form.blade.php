<form action="{{route('trainreport.update', $model->id)}}" method="post" class="train_report_form" enctype="multipart/form-data">
    @csrf
    {{ method_field('put') }}

    <div class="form-group">
        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} {{$model['is_departure'] ? 'checked' : ''}} type="checkbox" name="is_departure" value="1" class="jtoggler"></label>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Время</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="time" value="{{$model['time']}}" class="form-control time_input">
        </div>
    </div>

    <div class="form-block">
        @if(isset($model['day_photo']) && is_file('storage/images/'.$model['day_photo']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Фото за день</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="day_photo_file">
                                <label class="custom-file-label">Фото за день</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['day_photo']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Фото за день</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="day_photo_file">
                        <label class="custom-file-label">Фото за день</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="day_photo" value="{{ $model['day_photo'] }}">
    </div>

    <h3>Трек</h3>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Станция на сегодня</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="today_station" value="{{$model['today_station']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Осталось км.</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="number" name="rest_of_km" value="{{$model['rest_of_km']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Осталось Суток</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="number" name="rest_of_days" value="{{$model['rest_of_days']}}" class="form-control">
        </div>
    </div>

    <div class="form-block">
        @if(isset($model['waybill']) && is_file('storage/images/'.$model['waybill']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Накладная</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="waybill_file">
                                <label class="custom-file-label">Накладная</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['waybill']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Накладная</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="waybill_file">
                        <label class="custom-file-label">Накладная</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="waybill" value="{{ $model['waybill'] }}">
    </div>

    <div class="form-group">
        <textarea {{$canEdit ? '' : 'disabled'}} class="form-control" name="other" id="" cols="30" rows="10">{{$model['other']}}</textarea>
    </div>

    @if($canEdit)
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    @endif
</form>
