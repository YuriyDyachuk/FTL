@extends('page')

@php
    $clientTitle = 'Новый Клиент';
    if(!empty($client->name)){
        $clientTitle = 'FTL: '.$client->name;
    }
@endphp

@section('title', $clientTitle)

@section('content_header'){{ $clientTitle }}@stop

@section('content')
    @include('errors')
    <div class="kt-portlet__body">
        <form id="clientform" action="{{route('clients.update', ['client' => $client])}}" method="post">
            @csrf
            {{ method_field('put') }}
            <input type="hidden" name="client[id]" value="{{ $client->id }}">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Ответственный Менеджер</label>
                        <div class="col-lg-7">
                        <select name="client[responsible_manager_id]" class="form-control" required>
                            <option value=""></option>
                            @foreach(App\User::findByRolename('lead_manager') as $item)
                                <option {{ $item->id == $client->responsible_manager_id ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Название компании</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[name]" value="{{ $client['name'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">ИНН</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[inn]" value="{{ $client['inn'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">ОГРН</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[ogrn]" value="{{ $client['ogrn'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Юр.Адрес</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[leg_address]" value="{{ $client['leg_address'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Почт.Адрес</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[mail_address]" value="{{ $client['mail_address'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Факт.Адрес</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[fact_address]" value="{{ $client['fact_address'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Подписант</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[signatory]" value="{{ $client['signatory'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">ФИО</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[fio]" value="{{ $client['fio'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Доверенность</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[power_of_attorney]" value="{{ $client['power_of_attorney'] }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">КПП</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[kpp]" value="{{ $client['kpp'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">ОКПО</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[okpo]" value="{{ $client['okpo'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Банк</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[bank]" value="{{ $client['bank'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">БИК</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[bik]" value="{{ $client['bik'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">К - счет</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[k_account]" value="{{ $client['k_account'] }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-5 col-form-label">Р - счет</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="client[r_account]" value="{{ $client['r_account'] }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-5">
                    <h2>Контакты</h2>
                    <div class="under_line"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    @include('clients.contacts', ['client' => $client])
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-5">
                    <h3 class="mt-5"><i class="fas fa-location-arrow"></i> Регламент</h3>
                    <div class="under_line"></div>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-md-2">
                    <h3>Добавить файл</h3>
                    <div class="add_image_form">
                       <div class="form-group">
                           <label class="control-label">Тип</label>
                           <select class="type_id form-control">
                               @foreach(\App\Models\Helpers\ImageTypesHelper::getList() as $item)
                                   <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                           </select>
                       </div>
                        <input class="dont_update add_image_input mt-2" type="file" name="file">
                        <input type="hidden" class="client_id" value="{{$client->id}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="pl-4">
                        @if(!empty($images))
                            @foreach($images as $label => $image)
                                <div class="row">
                                    <p><b>{{ \App\Models\Helpers\ImageTypesHelper::getNameById($label) }}</b></p>
                                </div>
                                <div class="row">
                                    @foreach($image as $item)
                                        @if(is_file('storage/images/'.$item['file_name']))
                                            <div class="col-md-4 pl-0">
                                                <a class="table_form_link" data-fancybox="gallery"
                                                   href="{{ Storage::url('/images/'.$item['file_name']) }}">
                                                <span>
                                                    <img style="width: 50px;" class="img-responsive" src="/assets/media/files/pdf.svg" alt="">
                                                </span>
                                                </a>
                                                {{$item['name']}}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>


            <div class="row  mt-5 mb-4">
                <div class="col-md-5">
                    <h3>Фабула договора</h3>
                    <div class="under_line"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @include('clients.regulation', ['client' => $client])
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{ route('clients.index') }}">К списку</a>
                        <a href="#" class="btn btn-success save-form-btn">Сохранить</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @permission('client_delete')
        <div class="row">
            <div class="col-md-12 pl-5 mb-3">
                <form action="{{ route('clients.destroy', ['client' => $client]) }}" method="post">
                    @csrf
                    {{ method_field('delete') }}
                    <button onclick="return confirm('Вы подтверждаете удаление?');" type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    @endpermission
@stop



@section('js')
    <script>
        $(function(){
            function mainFunctions(){
                $('input[type="file"]').on('change',  function(){
                    if(!$(this).hasClass('dont_update')){
                        saveFormData(true, true);
                    }
                });
                $('.phone_input').inputmask('+7(999) 9999999');
            }
            mainFunctions();



            $('.save-form-btn').on('click', function (e) {
                e.preventDefault();
                return new Promise((resolve, reject) => {
                    saveFormData(true);
                    resolve();
                }).then(() => {
                    location.href = route('clients.index');
                })
            });
            $(document).on("click", ".untie-contact-js", function(e){
                e.preventDefault();
                $(this).closest('.contact-form-wrapper').remove();
                mainFunctions();
            });
            $(document).on("click", ".add_contact_form-js", function(e){
                e.preventDefault();
                var _this = $(this),
                    wrapper = _this.closest('.contact-wrapper'),
                    i = parseInt(wrapper.find('.contact-form-wrapper').last().data('i')) + 1;

                var tmpl = $.templates("#contactTemplate");
                var data = {id: i};
                var html = tmpl.render(data);
                _this.before(html);
                mainFunctions();

            });

            setInterval(function(){
                saveFormData(true);
            }, 5000);
            //$.notify.defaults({position: 'top right', autoHideDelay: 3000});


            $(document).on('change', '.add_image_input',  function () {
               // let formData = new FormData($(".add_image_form")[0]);

                var input = $(this);
                var fd = new FormData;
                let clientId = $('.add_image_form').find('.client_id').val();
                let typeId = $('.add_image_form').find('.type_id')[0].selectedOptions[0].value;

                fd.append('img', input.prop('files')[0]);

                fd.append('client_id', clientId);
                fd.append('type_id', typeId);

                $.ajax({
                    url: route('clients.addimage'),
                    dataType:'json',
                    async:false,
                    type:'post',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: (res) => {
                        location.reload();
                    },
                    error: () => {
                        console.log('client add image ajax request failed');
                    }
                });

            });

            function saveFormData(displayNotify = false, reload = false){
                let form = $('#clientform').serialize();
                let uri = route('clients.validateandsave');
                $.ajax({
                    url: uri,
                    dataType:'json',
                    async:false,
                    type:'post',
                    processData: false,
                    contentType: false,
                    data: new FormData($("#clientform")[0]),
                    success: function(res){
                        if(displayNotify === true){
                            if(JSON.parse(res) === 1){
                                if(reload === true){
                                    location.reload();
                                }
                                $.notify({
                            message: 'Сохранено'
                        },{
                            type: 'success'
                        });
                            }else{
                                Object.values(JSON.parse(res)).forEach(function(item){
                                    $.notify(item, "error");
                                });
                            }
                        }
                    },
                    error: function(){
                        $.notify({
                    message: 'Ошибка сохранения'
                },{
                    type: 'danger'
                });;
                    }
                });
            }
        });
    </script>
@stop
