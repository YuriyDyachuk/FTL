 <div style="position:relative;" class="wrapper_block clientrequest-{{$fromto}}-form-wrapper mb-5 mt-5" data-i="{{$n}}">
{{--     @if($fromto == 'from')--}}
{{--         <input value="{{$model['unl_date']}}" name="clientrequest[{{$fromto}}][{{$n}}][unl_date]" type="text" class="date_input form-control">--}}
{{--     @endif--}}
     @if($n !== 0)
        <a href="#" class="untie-clrqst{{$fromto}}_form-js pull-right btn btn-danger">-</a>
     @endif
    <div class="form-group row {{ $fromto == 'to' ? 'rqst_to_mt' : '' }}">
        <label class="col-lg-4 col-form-label">{{$fromto == 'from' ? 'Пункт A'.($n+1) : 'Пункт B'.($n+1)}}</label>
        <div class="col-lg-8">
            <select name="clientrequest[{{$fromto}}][{{$n}}][type]" class="{{ $fromto.'_select' }} form-control fromtype_select {{$fromto.'_select_'.$n}}" data-fromto="{{$fromto}}">
                <option value=""></option>
                @foreach(\App\Models\Entities\ClientRequestFrom::getTypeNames() as $key => $name)
                    @php
                        if($lead->type == $lead::CAR_TYPE && $key == \App\Models\Entities\ClientRequestFrom::TRAIN_ST_TYPE){
                            continue;
                        }
                    @endphp
                    <option {{ $model['type'] == $key ? 'selected' : '' }} value="{{ $key }}">
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
             <input value="{{$model['city']}}" type="text" class="form-control city_input" name="clientrequest[{{$fromto}}][{{$n}}][city]">
         </div>
     </div>

    <div class="fromtype_data">
        <div class="{{$model['type'] == \App\Models\Entities\ClientRequestFrom::ADDRESS_TYPE ? '' : 'd-none' }} address deldata" data-type="{{ \App\Models\Entities\ClientRequestFrom::ADDRESS_TYPE }}">
            @include('clientrequests.fromto.deldata.address',[
                'model' => $model,
                'fromto' => $fromto,
                'n' => $n
            ])
        </div>
        <div class="{{$model['type'] == \App\Models\Entities\ClientRequestFrom::TRAIN_ST_TYPE ? '' : 'd-none' }} trainst deldata" data-type="{{ \App\Models\Entities\ClientRequestFrom::TRAIN_ST_TYPE }}">
            @include('clientrequests.fromto.deldata.trainst',[
                'model' => $model,
                'fromto' => $fromto,
                'n' => $n
            ])
        </div>
        <div class="{{$model['type'] == \App\Models\Entities\ClientRequestFrom::FTL_WH_TYPE ? '' : 'd-none' }} ftlwh deldata" data-type="{{ \App\Models\Entities\ClientRequestFrom::FTL_WH_TYPE }}">
            @include('clientrequests.fromto.deldata.ftlwh',[
                'model' => $model,
                'fromto' => $fromto,
                'n' => $n
            ])
        </div>
    </div>

     <div class="form-group row">
         <label class="col-lg-4 col-form-label">Доверенность №</label>
         <div class="col-lg-8">
             <input value="{{$model['pickup_power_of_attorney_number']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][{{$n}}][pickup_power_of_attorney_number]">
         </div>
     </div>

     <div class="form-block">
         @if(is_file('storage/images/'.$model['pickup_power_of_attorney_scan']))
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group row">
                         <label class="col-lg-4 col-form-label">Доверенность Скан</label>
                         <div class="col-lg-7">
                             <div class="custom-file">
                                 <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][{{$n}}][pickup_power_of_attorney_scan_file]">
                                 <label class="custom-file-label"></label>
                             </div>
{{--                             <input class="form-control" type="file" name="clientrequest[{{$fromto}}][{{$n}}][pickup_power_of_attorney_scan_file]">--}}
                         </div>
                         <div class="col-lg-1 p-0">
                             <a class="table_form_link" data-fancybox="gallery"
                                href="{{ Storage::url('/images/'.$model['pickup_power_of_attorney_scan']) }}">
                                 <img style="width: 30px; display: block;" class="img-responsive" src="/images/document.png" alt="">
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         @else
             <div class="form-group row">
                 <label class="col-lg-4 col-form-label">Доверенность Скан</label>
                 <div class="col-lg-8">
                     <div class="custom-file">
                         <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][{{$n}}][pickup_power_of_attorney_scan_file]">
                         <label class="custom-file-label">Доверенность Скан</label>
                     </div>
                 </div>
             </div>
         @endif
         <input type="hidden" name="clientrequest[{{$fromto}}][{{$n}}][pickup_power_of_attorney_scan]" value="{{ $model['pickup_power_of_attorney_scan'] }}">
     </div>

     <div class="form-block">
         @if(isset($model['driving_scheme']) && is_file('storage/images/'.$model['driving_scheme']))
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group row">
                         <label class="col-lg-4 col-form-label">Схема проезда</label>
                         <div class="col-lg-7">
                             <div class="custom-file">
                                 <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][{{$n}}][driving_scheme_file]">
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
                         <input class="custom-file-input" type="file" name="clientrequest[{{$fromto}}][{{$n}}][driving_scheme_file]">
                         <label class="custom-file-label">Схема проезда</label>
                     </div>
                 </div>
             </div>
         @endif
         <input type="hidden" name="clientrequest[{{$fromto}}][{{$n}}][driving_scheme]" value="{{ $model['driving_scheme'] }}">
     </div>

     <h4>Контактное лицо</h4>
     @include('clientrequests.fromto.templates.contactsTemplate', ['fromto' => 'from', 'model' => $model, 'n' => $n])
     @include('clientrequests.fromto.templates.contactsTemplate', ['fromto' => 'to', 'model' => $model, 'n' => $n])
     @include('clientrequests.fromto.contacts', ['model' => $model, 'fromto' => $fromto, 'n' => $n])

{{--     <div class="form-group row">--}}
{{--         <label class="col-lg-4 col-form-label">ФИО</label>--}}
{{--         <div class="col-lg-8">--}}
{{--             <input value="{{$model['contact_name']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][{{$n}}][contact_name]">--}}
{{--         </div>--}}
{{--     </div>--}}

{{--     <div class="form-group row">--}}
{{--         <label class="col-lg-4 col-form-label">Телефон</label>--}}
{{--         <div class="col-lg-8">--}}
{{--             <input value="{{$model['contact_phone']}}" type="text" class="form-control phone_input" name="clientrequest[{{$fromto}}][{{$n}}][contact_phone]">--}}
{{--         </div>--}}
{{--     </div>--}}


</div>
 @if($showPlusBtn == true)
     <a href="#" class="add_clrqst{{$fromto}}_form-js btn btn-primary">+</a>
 @endif
