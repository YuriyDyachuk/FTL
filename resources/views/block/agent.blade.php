<h3>{{ $model->getBlockTitle() }}</h3>
<form method="post" enctype="multipart/form-data" class="block_form">
{{--    @csrf--}}
    {{ method_field('put') }}
    <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::AGENT_TYPE}}">
    <input type="hidden" name="id" value="{{$model->id}}">
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
        <label class="col-lg-4 col-form-label">Доверенность №</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="num" value="{{ $model['num'] }}">
        </div>
    </div>
    <div class="form-block">
        @if(isset($model['scan']) && is_file('storage/images/'.$model['scan']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Доверенность скан</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="scan_file">
                                <label class="custom-file-label">Доверенность скан</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['scan']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Доверенность скан</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input class="custom-file-input" type="file" name="scan_file">
                        <label class="custom-file-label">Доверенность скан</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="scan" value="{{ $model['scan'] }}">
    </div>
</form>
