<form action="{{route('forwardingreport.update', $model->id)}}" method="post" class="forwarding_report_form" enctype="multipart/form-data">
    @csrf
    {{ method_field('put') }}

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Утепление</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="warming" value="{{$model['warming']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Полиэтиленовая плёнка 1-2 слоя</label>
        <div class="col-lg-8">
            <input type="text" {{$canEdit ? '' : 'disabled'}} name="plastic_film" value="{{$model['plastic_film']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Пенопласт 1200*2400*40</label>
        <div class="col-lg-6">
            <input type="text" {{$canEdit ? '' : 'disabled'}} name="styrofoam" value="{{$model['styrofoam']}}" class="form-control">
        </div>
        <div class="col-md-2">
            <input placeholder="Кол-во листов" {{$canEdit ? '' : 'disabled'}} type="text" name="styrofoam_count" value="{{$model['styrofoam_count']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Оргалит 1200*2400</label>
        <div class="col-lg-6">
            <input type="text" {{$canEdit ? '' : 'disabled'}} name="hardboard" value="{{$model['hardboard']}}" class="form-control">
        </div>
        <div class="col-md-2">
            <input placeholder="Кол-во листов" {{$canEdit ? '' : 'disabled'}} type="text" name="hardboard_count" value="{{$model['hardboard_count']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">ОSB 2500*1250*9</label>
        <div class="col-lg-6">
            <input type="text" {{$canEdit ? '' : 'disabled'}} name="osb" value="{{$model['osb']}}" class="form-control">
        </div>
        <div class="col-md-2">
            <input placeholder="Кол-во листов" {{$canEdit ? '' : 'disabled'}} type="text" name="osb_count" value="{{$model['osb_count']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Картон 1200*2200</label>
        <div class="col-lg-6">
            <input type="text" {{$canEdit ? '' : 'disabled'}} name="cardboard" value="{{$model['cardboard']}}" class="form-control">
        </div>
        <div class="col-md-2">
            <input placeholder="Кол-во листов" {{$canEdit ? '' : 'disabled'}} type="text" name="cardboard_count" value="{{$model['cardboard_count']}}" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Стрейч плёнка</label>
        <div class="col-lg-8">
            <input type="text" {{$canEdit ? '' : 'disabled'}} name="streych_film" value="{{$model['streych_film']}}" class="form-control">
        </div>
    </div>

    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="crate_enabled" type="checkbox" value="1" {{$model['crate_enabled'] ? 'checked' : ''}}> Обрешётка</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['crate_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['crate_photo']) && is_file('storage/images/'.$model['crate_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="crate_photo_file">
                                                    <label class="custom-file-label">Обрешётка</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['crate_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="crate_photo_file">
                                            <label class="custom-file-label">Обрешётка</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="crate_photo" value="{{ $model['crate_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Поддон EUR</label>
        <div class="col-lg-8">
            <input type="checkbox" {{$canEdit ? '' : 'disabled'}} name="evr_pallet_enabled" value="1" {{$model['evr_pallet_enabled'] ? 'checked' : ''}}>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Пересчёт мест</label>
        <div class="col-lg-8">
            <input type="text" {{$canEdit ? '' : 'disabled'}} name="places_recalculation" value="{{$model['places_recalculation']}}" class="form-control">
        </div>
    </div>

    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input placeholder="Пересчёт внутри тарных вложений" {{$canEdit ? '' : 'disabled'}} class="form-control" name="internal_investments_recalculation" type="text" value="{{$model['internal_investments_recalculation']}}">
                    </div>
                    <div class="col-sm-8">
                        <div class="">
                            @if(isset($model['internal_investments_recalculation_photo']) && is_file('storage/images/'.$model['internal_investments_recalculation_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" {{$canEdit ? '' : 'disabled'}} type="file" name="internal_investments_recalculation_photo_file">
                                                    <label class="custom-file-label">Пересчёт внутри тарных вложений</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['internal_investments_recalculation_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input class="custom-file-input" type="file" {{$canEdit ? '' : 'disabled'}} name="internal_investments_recalculation_photo_file">
                                            <label class="custom-file-label">Пересчёт внутри тарных вложений</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="internal_investments_recalculation_photo" value="{{ $model['internal_investments_recalculation_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="stickering_enabled" type="checkbox" value="1" {{$model['stickering_enabled'] ? 'checked' : ''}}> Стикировка</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['stickering_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['stickering_photo']) && is_file('storage/images/'.$model['stickering_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="stickering_photo_file">
                                                    <label class="custom-file-label">Стикировка</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['stickering_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="stickering_photo_file">
                                            <label class="custom-file-label">Стикировка</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="stickering_photo" value="{{ $model['stickering_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="seat_filling_enabled" type="checkbox" value="1" {{$model['seat_filling_enabled'] ? 'checked' : ''}}> Пломбирование места</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['seat_filling_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['seat_filling_photo']) && is_file('storage/images/'.$model['seat_filling_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="seat_filling_photo_file">
                                                    <label class="custom-file-label">Пломбирование места</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['seat_filling_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="seat_filling_photo_file">
                                            <label class="custom-file-label">Пломбирование места</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="seat_filling_photo" value="{{ $model['seat_filling_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="pallet_formation_enabled" type="checkbox" value="1" {{$model['pallet_formation_enabled'] ? 'checked' : ''}}> Формирование паллет</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['pallet_formation_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['pallet_formation_photo']) && is_file('storage/images/'.$model['pallet_formation_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="pallet_formation_photo_file">
                                                    <label class="custom-file-label">Формирование паллет</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['pallet_formation_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input class="custom-file-input" {{$canEdit ? '' : 'disabled'}} type="file" name="pallet_formation_photo_file">
                                            <label class="custom-file-label">Формирование паллет</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="pallet_formation_photo" value="{{ $model['pallet_formation_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="parameters_formation_enabled" type="checkbox" value="1" {{$model['parameters_formation_enabled'] ? 'checked' : ''}}> Формирование ассортимента по параметрам</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['parameters_formation_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['parameters_formation_photo']) && is_file('storage/images/'.$model['parameters_formation_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="parameters_formation_photo_file">
                                                    <label class="custom-file-label">Формирование ассортимента по параметрам</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['parameters_formation_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="parameters_formation_photo_file">
                                            <label class="custom-file-label">Формирование ассортимента по параметрам</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="parameters_formation_photo" value="{{ $model['parameters_formation_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="knitting_wire_fixation_enabled" type="checkbox" value="1" {{$model['knitting_wire_fixation_enabled'] ? 'checked' : ''}}> Фиксация вязальной проволокой</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['knitting_wire_fixation_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['knitting_wire_fixation_photo']) && is_file('storage/images/'.$model['knitting_wire_fixation_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="knitting_wire_fixation_photo_file">
                                                    <label class="custom-file-label">Фиксация вязальной проволокой</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['knitting_wire_fixation_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="knitting_wire_fixation_photo_file">
                                            <label class="custom-file-label">Фиксация вязальной проволокой</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="knitting_wire_fixation_photo" value="{{ $model['knitting_wire_fixation_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="sealing_van_enabled" type="checkbox" value="1" {{$model['sealing_van_enabled'] ? 'checked' : ''}}> Пломбирования фургона</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['sealing_van_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['sealing_van_photo']) && is_file('storage/images/'.$model['sealing_van_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="sealing_van_photo_file">
                                                    <label class="custom-file-label">Пломбирования фургона</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['sealing_van_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="sealing_van_photo_file">
                                            <label class="custom-file-label">Пломбирования фургона</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="sealing_van_photo" value="{{ $model['sealing_van_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toggle_main_block">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-sm-4 toggle_checkbox">
                        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} name="photofix_enabled" type="checkbox" value="1" {{$model['photofix_enabled'] ? 'checked' : ''}}> Фото фиксация</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="toggle_block {{$model['photofix_enabled'] ? '' : 'd-none'}}">
                            @if(isset($model['photofix_photo']) && is_file('storage/images/'.$model['photofix_photo']))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <div class="custom-file">
                                                    <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="photofix_photo_file">
                                                    <label class="custom-file-label">Фото фиксация</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$model['photofix_photo']) }}">
                                                    <img style="width: 30px; display: block" class="img-responsive" src="/images/document.png" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="custom-file">
                                            <input {{$canEdit ? '' : 'disabled'}} class="custom-file-input" type="file" name="photofix_photo_file">
                                            <label class="custom-file-label">Фото фиксация</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <input type="hidden" name="photofix_photo" value="{{ $model['photofix_photo'] }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($canEdit)
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    @endif
</form>
