<script id="clRqstToTemplate" type="text/html">
    <div style="position: relative;" class="wrapper_block clientrequest-{{$fromto}}-form-wrapper  mb-5 mt-5" data-i="@{{:i}}">
        <a href="#" class="untie-clrqstto_form-js pull-right btn btn-danger">-</a>

        <input type="hidden" class="form-control" name="clientrequest[{{$fromto}}][@{{:i}}][city]">


        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Пункт B@{{:i+1}}</label>
            <div class="col-lg-8">
                <select name="clientrequest[{{$fromto}}][@{{:i}}][type]" class="to_select form-control fromtype_select" data-fromto="{{$fromto}}">
                    <option value=""></option>
                    @foreach(\App\Models\Entities\ClientRequestFrom::getTypeNames() as $key => $name)
                        <option {{ $key == \App\Models\Entities\ClientRequestFrom::ADDRESS_TYPE ? 'selected' : '' }} value="{{ $key }}">
                            @if($key == \App\Models\Entities\ClientRequestFrom::ADDRESS_TYPE && $fromto == 'from')
                                Склад Поставщика
                            @elseif($key == \App\Models\Entities\ClientRequestFrom::ADDRESS_TYPE && $fromto == 'to')
                                Склад Клиента
                            @else
                                {{ $name }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Город</label>
            <div class="col-lg-8">
                <input value="{{$model['city']}}" type="text" class="form-control city_input" name="clientrequest[{{$fromto}}][@{{:i}}][city]">
            </div>
        </div>

        <div class="fromtype_data">
            <div class="address deldata" data-type="{{ \App\Models\Entities\ClientRequestFrom::ADDRESS_TYPE }}">
                @include('clientrequests.fromto.deldata.address',[
                    'model' => $model,
                    'fromto' => $fromto,
                    'n' => '@{{:i}}'
                ])
            </div>
            <div class="d-none trainst deldata" data-type="{{ \App\Models\Entities\ClientRequestFrom::TRAIN_ST_TYPE }}">
                @include('clientrequests.fromto.deldata.trainst',[
                    'model' => $model,
                    'fromto' => $fromto,
                    'n' => '@{{:i}}'
                ])
            </div>
            <div class="d-none ftlwh deldata" data-type="{{ \App\Models\Entities\ClientRequestFrom::FTL_WH_TYPE }}">
                @include('clientrequests.fromto.deldata.ftlwh',[
                    'model' => $model,
                    'fromto' => $fromto,
                    'n' => '@{{:i}}'
                ])
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Доверенность №</label>
            <div class="col-lg-8">
                <input value="{{$model['pickup_power_of_attorney_number']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][@{{:i}}][pickup_power_of_attorney_number]">
            </div>
        </div>

        <div class="form-block">
            @if(is_file('storage/images/'.$model['pickup_power_of_attorney_scan']))
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Доверенность Скан</label>
                            <div class="col-lg-8">
                                <div class="custom-file">
                                    <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][@{{:i}}][pickup_power_of_attorney_scan_file]">
                                    <label class="custom-file-label">Доверенность Скан</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a class="table_form_link" data-fancybox="gallery"
                           href="{{ Storage::url('/images/'.$model['pickup_power_of_attorney_scan']) }}">
                            <img style="width: 150px;" class="img-responsive" src="/images/document.png" alt="">
                        </a>
                    </div>
                </div>
            @else
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Доверенность Скан</label>
                    <div class="col-lg-8">
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][@{{:i}}][pickup_power_of_attorney_scan_file]">
                            <label class="custom-file-label">Доверенность Скан</label>
                        </div>
                    </div>
                </div>
            @endif
            <input type="hidden" name="clientrequest[{{$fromto}}][@{{:i}}][pickup_power_of_attorney_scan]" value="{{ $model['pickup_power_of_attorney_scan'] }}">
        </div>

        <div class="form-block">
            @if(isset($model['driving_scheme']) && is_file('storage/images/'.$model['driving_scheme']))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Схема проезда</label>
                            <div class="col-lg-7">
                                <div class="custom-file">
                                    <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][@{{:i}}][driving_scheme_file]">
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
                            <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][@{{:i}}][driving_scheme_file]">
                            <label class="custom-file-label">Схема проезда</label>
                        </div>
                    </div>
                </div>
            @endif
            <input type="hidden" name="clientrequest[{{$fromto}}][@{{:i}}][driving_scheme]" value="{{ $model['driving_scheme'] }}">
        </div>

        <h4>Контактное лицо</h4>

        @include('clientrequests.fromto.contacts', ['model' => $model, 'fromto' => $fromto, 'n' => '@{{:i}}'])

{{--        <div class="form-group row">--}}
{{--            <label class="col-lg-4 col-form-label">ФИО</label>--}}
{{--            <div class="col-lg-8">--}}
{{--                <input value="{{$model['contact_name']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][@{{:i}}][contact_name]">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="form-group row">--}}
{{--            <label class="col-lg-4 col-form-label">Телефон</label>--}}
{{--            <div class="col-lg-8">--}}
{{--                <input value="{{$model['contact_phone']}}" type="text" class="form-control phone_input" name="clientrequest[{{$fromto}}][@{{:i}}][contact_phone]">--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
</script>
