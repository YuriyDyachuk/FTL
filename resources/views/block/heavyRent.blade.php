<h2>{{ $model->getBlockTitle() }}</h2>

<form method="post" enctype="multipart/form-data" class="block_form">
{{--    @csrf--}}
    {{ method_field('put') }}
    <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::HEAVY_RENT_TYPE}}">
    <input type="hidden" name="id" value="{{$model->id}}">
    <h4>Начало операции</h4>
    @include('block.heavyRentDateTime.begin', ['model' => $model])
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Адрес</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="address" value="{{ $model['address'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">ФИО</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="fio" value="{{ $model['fio'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Телефон</label>
        <div class="col-lg-8">
            <input type="text" class="form-control phone_input" name="phone" value="{{ $model['phone'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Масса одного грузового места, кг</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="place_weight" value="{{ $model['place_weight'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Габариты грузового места</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="place_size" value="{{ $model['place_size'] }}">
        </div>
    </div>
    <div class="form-block">
        @if(isset($model['cargo_photo']) && is_file('storage/images/'.$model['cargo_photo']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Фото груза</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="cargo_photo_file">
                                <label class="custom-file-label">Фото груза</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['cargo_photo']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Фото груза</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input class="custom-file-input" type="file" name="cargo_photo_file">
                        <label class="custom-file-label">Фото груза</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="cargo_photo" value="{{ $model['cargo_photo'] }}">
    </div>
    <h4>Окончание операции</h4>
    @include('block.heavyRentDateTime.end', ['model' => $model])
</form>

{{--@if($model->moreFilesBlock()->exists())--}}
{{--    @include('block.agent', ['model' => $model->moreFilesBlock])--}}
{{--@endif--}}

{{--@if($model->agentBlock()->exists())--}}
{{--    @include('block.agent', ['model' => $model->agentBlock])--}}
{{--@endif--}}
