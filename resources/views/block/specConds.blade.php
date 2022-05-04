<h2>{{ $model->getBlockTitle() }}</h2>

<form method="post" enctype="multipart/form-data" class="block_form no_disable_form">
{{--    @csrf--}}
    {{ method_field('put') }}
    <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::SPEC_CONDS_TYPE}}">
    <input type="hidden" name="id" value="{{$model->id}}">
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Крепление груза. Описание</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="description" value="{{ $model['description'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Особые условия транспортировки Груза</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="transport" value="{{ $model['transport'] }}">
        </div>
    </div>
    <div class="form-block">
        @if(isset($model['file']) && is_file('storage/images/'.$model['file']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Крепление груза. Файл</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="file_file">
                                <label class="custom-file-label">Крепление груза. Файл</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['file']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Крепление груза. Файл</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input class="custom-file-input" type="file" name="file_file">
                        <label class="custom-file-label">Крепление груза. Файл</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="file" value="{{ $model['file'] }}">
    </div>
</form>
