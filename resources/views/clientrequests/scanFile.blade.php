<div class="row">
    <div class="col-md-8">
        <label class="col-lg-4 col-form-label">Доверенность Скан из Данных по ЖД Сделке:</label>
        @if(!empty($files) && is_countable($files))
        @foreach($files as $fileArray)
                @if(is_countable($fileArray))
            @foreach($fileArray as $file)
                @if(!is_null($file) && is_file('storage/images/'.$file))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-lg-1 p-0">
                                    <a class="table_form_link" data-fancybox="gallery"
                                       href="{{ Storage::url('/images/'.$file) }}">
                                        <img style="width: 30px; display: block;" class="img-responsive" src="/images/document.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
                @endif
        @endforeach
            @endif
    </div>
</div>
