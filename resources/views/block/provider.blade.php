<h2>{{ $model->getBlockTitle() }}</h2>

@if($model->dateTimeBlock()->exists())
    @include('block.dateTime', ['model' => $model->dateTimeBlock])
@endif

<form method="post" enctype="multipart/form-data" class="block_form">
{{--    @csrf--}}
    {{ method_field('put') }}
    <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::PROVIDER_TYPE}}">
    <input type="hidden" name="id" value="{{$model->id}}">
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Город</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="city" value="{{ $model['city'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Адрес</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="address" value="{{ $model['address'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Наименование</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="name" value="{{ $model['name'] }}">
        </div>
    </div>
    <div class="form-block">
        @if(isset($model['driving_scheme']) && is_file('storage/images/'.$model['driving_scheme']))
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Схема проезда</label>
                        <div class="col-lg-7">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="driving_scheme_file">
                                <label class="custom-file-label">Схема проезда</label>
                            </div>
                        </div>
                        <div class="col-lg-1 p-0">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['driving_scheme']) }}">
                                <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Схема проезда</label>
                <div class="col-lg-8">
                    <div class="custom-file">
                        <input class="custom-file-input" type="file" name="driving_scheme_file">
                        <label class="custom-file-label">Схема проезда</label>
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name="driving_scheme" value="{{ $model['driving_scheme'] }}">
    </div>
</form>

@if($model->agentBlock()->exists())
    @foreach($model->agentBlock as $agent)
        <div style="margin-top: 41px;">
            @include('block.agent', ['model' => $agent])
        </div>
    @endforeach
@endif
