{{--@extends('page')--}}

{{--@section('title', 'FTL: Сделки')--}}

{{--@section('content_header')Новая сделка@stop--}}

{{--@section('content')--}}
{{--    @include('errors')--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <form action="{{route('leads.store')}}" method="post" target="_blank">--}}
{{--                @csrf--}}
{{--                {{ method_field('post') }}--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="col-sm-3">--}}
{{--                        --}}{{--                    <h3>Сделка</h3>--}}
{{--                        <input type="hidden" name="lead[id]" value="{{ $lead->id }}">--}}
{{--                        --}}{{--                    <div class="form-group">--}}
{{--                        --}}{{--                        <label class="control-label">Клиент</label>--}}
{{--                        --}}{{--                        <input class="form-control" type="text" name="lead[client]">--}}
{{--                        --}}{{--                    </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label class="control-label">КТК номер</label>--}}
{{--                            <input class="form-control" type="text" name="lead[ktk_number]">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label">КТК префикс</label>--}}
{{--                            <input class="form-control" type="text" name="lead[ktk_prefix]">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label">Собственник КТК / вагона</label>--}}
{{--                            <input type="text" class="form-control" name="lead[railway_carriage_ktk_owner]">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            <div class="col-sm-12">--}}
{{--                <div class="col-sm-4">--}}
{{--                    @include('leads.products.form', ['lead' => $lead])--}}
{{--                </div>--}}
{{--                <div class="col-sm-7 col-sm-offset-1">--}}
{{--                    <h2>Заявки</h2>--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <ul class="nav nav-pills nav-stacked">--}}
{{--                            <li class="active"><a data-toggle="tab" href="#form1">Авто Заявка: Поставщик - Склад ФТЛ</a></li>--}}
{{--                            <li><a data-toggle="tab" href="#form2">Авто Заявка: Терминал - Склад ФТЛ - ЖД Станция</a></li>--}}
{{--                            <li><a data-toggle="tab" href="#form3">Склад Заявка: Приём</a></li>--}}
{{--                            <li><a data-toggle="tab" href="#form4">Склад Заявка: Экспедирование на приёме</a></li>--}}

{{--                            <li><a data-toggle="tab" href="#form5">Склад Заявка: Загрузка Контейнера</a></li>--}}
{{--                            <li><a data-toggle="tab" href="#form6">Склад Заявка: Кросс-докинг</a></li>--}}
{{--                            <li><a data-toggle="tab" href="#form7">Склад Заявка: Экспедирование Загрузка Контейнера</a></li>--}}

{{--                            <li><a data-toggle="tab" href="#form8">Авто Заявка: со Склада на ЖД станцию</a></li>--}}
{{--                            <li><a data-toggle="tab" href="#form9">ЖД Заявка</a></li>--}}
{{--                            <li><a data-toggle="tab" href="#form10">Авто Заявка: с ЖД станции к Клиенту</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-9">--}}
{{--                        <div class="tab-content">--}}
{{--                            <div id="form1" class="tab-pane fade in active">--}}
{{--                                @include('leads.forms.carRequestPullCargoFromClientToOurWarehouse', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form2" class="tab-pane fade">--}}
{{--                                @include('leads.forms.carRequestPullContainerFromTerminalToWarehouse', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form3" class="tab-pane fade">--}}
{{--                                @include('leads.forms.warehouseRequestGetting', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form4" class="tab-pane fade">--}}
{{--                                @include('leads.forms.warehouseRequestForwardingOnGetting', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form5" class="tab-pane fade">--}}
{{--                                @include('leads.forms.warehouseRequestContainerDownloading', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form6" class="tab-pane fade">--}}
{{--                                @include('leads.forms.warehouseRequestCrossDocking', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form7" class="tab-pane fade">--}}
{{--                                @include('leads.forms.warehouseRequestForwardingContainerDownloading', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form8" class="tab-pane fade">--}}
{{--                                @include('leads.forms.carRequestFromWarehouseToTrainStation', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form9" class="tab-pane fade">--}}
{{--                                @include('leads.forms.trainRequest', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                            <div id="form10" class="tab-pane fade">--}}
{{--                                @include('leads.forms.carRequestFromTrainStationToClient', ['lead' => $lead])--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--                <div class="col-sm-12"><br><br><button type="submit" class="btn btn-success">Сохранить</button></div>--}}
{{--        </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@stop--}}

{{--@section('js')--}}
{{--    <script>--}}
{{--        $(function(){--}}
{{--            $('form').on('keyup change paste', 'input, select, textarea', function(e){--}}
{{--                // $(this).on('blur', function(e){--}}
{{--                //     e.preventDefault();--}}
{{--                //     return false;--}}
{{--                // });--}}
{{--                let form = $(this).closest('form').serialize();--}}
{{--                let uri = route('leads.validateandsave');--}}
{{--                //$.notify.defaults({position: 'top right', autoHideDelay: 3000});--}}
{{--                $.notify("Выполняется сохранение...", "info");--}}
{{--                setTimeout(function(){--}}
{{--                    $.ajax({--}}
{{--                        url: uri,--}}
{{--                        type: 'put',--}}
{{--                        data: form,--}}
{{--                        success: function(res){--}}
{{--                            if(JSON.parse(res) === 1){--}}
{{--                                $.notify("Сделка успешно сохранена", "success");--}}
{{--                            }else{--}}
{{--                                Object.values(JSON.parse(res)).forEach(function(item, i){--}}
{{--                                    $.notify(item, "error");--}}
{{--                                });--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function(){--}}
{{--                            $.notify({--}}
{{--                    message: 'Ошибка сохранения'--}}
{{--                },{--}}
{{--                    type: 'danger'--}}
{{--                });;--}}
{{--                        }--}}
{{--                    });--}}
{{--                }, 3000);--}}
{{--            });--}}

{{--            $(document).on("click", ".untie-product-js", function(e){--}}
{{--                e.preventDefault();--}}
{{--                $(this).closest('.product-form-wrapper').remove();--}}
{{--            });--}}
{{--            $(document).on("click", ".add_product_form-js", function(e){--}}
{{--                e.preventDefault();--}}
{{--                var _this = $(this),--}}
{{--                    wrapper = _this.closest('.product-wrapper'),--}}
{{--                    i = parseInt(wrapper.find('.product-form-wrapper').last().data('i')) + 1;--}}

{{--                var tmpl = $.templates("#productTemplate");--}}
{{--                var data = {id: i};--}}
{{--                var html = tmpl.render(data);--}}
{{--                _this.before(html);--}}
{{--            });--}}


{{--            $(document).on("click", ".untie-dt-js", function(e){--}}
{{--                e.preventDefault();--}}
{{--                $(this).closest('.dt-form-wrapper').remove();--}}
{{--            });--}}
{{--            $(document).on("click", ".add_dt_form-js", function(e){--}}
{{--                e.preventDefault();--}}
{{--                var _this = $(this),--}}
{{--                    wrapper = _this.closest('.product-dt-wrapper'),--}}
{{--                    i = parseInt($(this).closest('.product-form-wrapper').data('i'));--}}

{{--                var tmpl = $.templates("#dtTemplate");--}}
{{--                var data = {id: i};--}}
{{--                var html = tmpl.render(data);--}}
{{--                _this.before(html);--}}
{{--            });--}}

{{--            // $(document).on('change', '.download_type_select', function(){--}}
{{--            //     let downloadTypeValue = this.value;--}}
{{--            //     if(downloadTypeValue === 'pallet'){--}}
{{--            //         $(this).closest('.row').find('.pallet-data').removeClass('d-none');--}}
{{--            //         $(this).closest('.row').find('.naval-data').addClass('d-none');--}}
{{--            //         $(this).closest('.row').find('.naval-data input').val('');--}}
{{--            //     }else{--}}
{{--            //         $(this).closest('.row').find('.naval-data').removeClass('d-none');--}}
{{--            //         $(this).closest('.row').find('.pallet-data').addClass('d-none');--}}
{{--            //         $(this).closest('.row').find('.pallet-data input, .pallet-data select').val('');--}}
{{--            //     }--}}
{{--            // });--}}

{{--            $(document).on('change', '.is_need_to_use_form', function(){--}}
{{--                let isChecked = this.checked,--}}
{{--                    formDataBlock = $(this).closest('.form_block').find('.form_data');--}}
{{--                if(isChecked === true){--}}
{{--                    $(formDataBlock).removeClass('d-none');--}}
{{--                }else{--}}
{{--                    $(formDataBlock).addClass('d-none');--}}
{{--                    $(formDataBlock).find('input, select').val('');--}}
{{--                }--}}
{{--            });--}}

{{--            $('.loading_date').datepicker({--}}
{{--                format: "dd.mm.yyyy",--}}
{{--                autoClose: true,--}}
{{--                minDate: new Date(),--}}
{{--                language: 'ru'--}}
{{--            });--}}
{{--            $('.loading_time').timepicker({--}}
{{--                timeFormat: 'HH:mm',--}}
{{--                interval: 60,--}}
{{--                maxTime: '23:59',--}}
{{--                startTime: '00:00',--}}
{{--                dynamic: false,--}}
{{--                dropdown: true,--}}
{{--                scrollbar: true--}}
{{--            });--}}

{{--            $('.unloading_date').datepicker({--}}
{{--                format: "dd.mm.yyyy",--}}
{{--                autoClose: true,--}}
{{--                minDate: new Date(),--}}
{{--                language: 'ru'--}}
{{--            });--}}
{{--            $('.unloading_time').timepicker({--}}
{{--                timeFormat: 'HH:mm',--}}
{{--                interval: 60,--}}
{{--                maxTime: '23:59',--}}
{{--                startTime: '00:00',--}}
{{--                dynamic: false,--}}
{{--                dropdown: true,--}}
{{--                scrollbar: true--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@stop--}}
