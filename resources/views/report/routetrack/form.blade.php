<form action="{{route('routetrackreport.update', $model->id)}}" enctype="multipart/form-data" class="routetrack_report_form" method="post">
    @csrf
    {{ method_field('put') }}
    <div class="form-block">
        @if(isset($model['track_photo']) && is_file('storage/images/'.$model['track_photo']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Трек Маршрут</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="track_photo_file">
                                <label class="custom-file-label">Трек Маршрут</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['track_photo']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Трек Маршрут</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="track_photo_file">
                        <label class="custom-file-label">Трек Маршрут</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="track_photo" value="{{ $model['track_photo'] }}">
    </div>
    @if($model->order->name == \App\Models\Entities\Order::CAR_HEAVY_RENT_NAME)
        <div class="form-block">
            @if(isset($model['endpoint_photo']) && is_file('storage/images/'.$model['endpoint_photo']))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Фото на Выполнении</label>
                            <div class="col-lg-7">
                                <div class="custom-file">
                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="endpoint_photo_file">
                                    <label class="custom-file-label">Фото на Выполнении</label>
                                </div>
                            </div>
                            <div class="col-lg-1 p-0">
                                <a class="table_form_link" data-fancybox="gallery"
                                   href="{{ Storage::url('/images/'.$model['endpoint_photo']) }}">
                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Фото на Выполнении</label>
                    <div class="col-lg-8">
                        <div class="custom-file">
                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="endpoint_photo_file">
                            <label class="custom-file-label">Фото на Выполнении</label>
                        </div>
                    </div>
                </div>
            @endif
            <input type="hidden" name="endpoint_photo" value="{{ $model['endpoint_photo'] }}">
        </div>

        <div class="form-block">
            @if(isset($model['waybill_photo']) && is_file('storage/images/'.$model['waybill_photo']))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Накладная</label>
                            <div class="col-lg-7">
                                <div class="custom-file">
                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="waybill_photo_file">
                                    <label class="custom-file-label">Накладная</label>
                                </div>
                            </div>
                            <div class="col-lg-1 p-0">
                                <a class="table_form_link" data-fancybox="gallery"
                                   href="{{ Storage::url('/images/'.$model['waybill_photo']) }}">
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
                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="waybill_photo_file">
                            <label class="custom-file-label">Накладная</label>
                        </div>
                    </div>
                </div>
            @endif
            <input type="hidden" name="waybill_photo" value="{{ $model['waybill_photo'] }}">
        </div>
    @else
        <input type="hidden" name="endpoint_photo" value="{{ $model['endpoint_photo'] }}">
        <input type="hidden" name="waybill_photo" value="{{ $model['waybill_photo'] }}">
    @endif

    @if($canEdit)
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    @endif
</form>
