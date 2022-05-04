<form action="{{route('whgettingreport.update', $model->id)}}" enctype="multipart/form-data" class="whgetting_report_form" method="post">
    @csrf
    {{ method_field('put') }}

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Дата</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="date" value="{{$model['date']}}" class="form-control date_input">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Время</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="time" value="{{$model['time']}}" class="form-control time_input">
        </div>
    </div>

    <div class="form-block">
        @if(isset($model['photo']) && is_file('storage/images/'.$model['photo']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Фото на Приёме</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="photo_file">
                                <label class="custom-file-label">Фото на Приёме</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['photo']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Фото на Приёме</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="photo_file">
                        <label class="custom-file-label">Фото на Приёме</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="photo" value="{{ $model['photo'] }}">
    </div>
    @if($canEdit)
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    @endif
</form>
