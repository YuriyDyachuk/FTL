<div class="col-sm-12 pl0">
    <div class="col-sm-4 pl0">
        <ul class="nav nav-pills nav-stacked">
            @permission('car_edit')
                <li class="active"><a data-toggle="tab" href="#form1">Авто Заявка: Поставщик - Склад ФТЛ «Авто:К-Скл» <span class="bg-primary">({{ $lead->carRqstClWh()->count() }})</span></a></li>
                <li><a data-toggle="tab" href="#form2">Авто Заявка: Терминал - Склад ФТЛ - ЖД Станция «Авто:КТК» <span class="bg-primary">({{ $lead->carRqstTmWh()->count() }})</span></a></li>
            @endpermission

            @permission('wh_edit')
                <li><a data-toggle="tab" href="#form10">Склад Заявка: Приём «Склад:П» <span class="bg-primary">({{ $lead->whGt()->count() }})</span></a></li>
                <li><a data-toggle="tab" href="#form3">Склад Заявка: Загрузка КТК «Склад:З-КТК» <span class="bg-primary">({{ $lead->whKtkDown()->count() }})</span></a></li>
                <li><a data-toggle="tab" href="#form4">Склад Заявка: Кросс-Докинг <span class="bg-primary">({{ $lead->whCross()->count() }})</span></a></li>
            @endpermission

            @permission('car_edit')
                <li><a data-toggle="tab" href="#form5">Авто Заявка: со Склада на ЖД станцию «Авто: Скл-ЖД» <span class="bg-primary">({{ $lead->carWhTr()->count() }})</span></a></li>
            @endpermission

            @permission('tr_edit')
                <li><a data-toggle="tab" href="#form6">ЖД <span class="bg-primary">({{ $lead->tr()->count() }})</span></a></li>
                <li><a data-toggle="tab" href="#form7">ЖД Заявка: Кросс-докинг «ЖД:К-Д» <span class="bg-primary">({{ $lead->trCross()->count() }})</span></a></li>
            @endpermission

            @permission('car_edit')
                <li><a data-toggle="tab" href="#form11">Авто Заявка: ЖД Станция - Склад Клиента - Терминал «Авто: ЖД-С» <span class="bg-primary">({{ $lead->carTrWh()->count() }})</span></a></li>
                <li><a data-toggle="tab" href="#form8">Авто Заявка: подача Груза – со Склада ФТЛ Клиенту «Авто:Скл-К» <span class="bg-primary">({{ $lead->carWhCl()->count() }})</span></a></li>
                <li><a data-toggle="tab" href="#form9">Авто Заявка: возврат Контейнера – со Склада на Терминал «Авто:возвр КТК» <span class="bg-primary">({{ $lead->carWhTm()->count() }})</span></a></li>
                <li><a data-toggle="tab" href="#form12">Авто: Заказ тяж. техники <span class="bg-primary">({{ $lead->carLdcrRent()->count() }})</span></a></li>
            @endpermission
        </ul>
    </div>
    <div class="col-sm-8">
        <div class="tab-content">
            @permission('car_edit')
            <div id="form1" class="tab-pane fade in active">
                @include('orderforms.carrqstclwh.form', ['lead' => $lead])
            </div>
            <div id="form2" class="tab-pane fade">
                @include('orderforms.carrqsttmwh.form', ['lead' => $lead])
            </div>
            @endpermission

            @permission('wh_edit')
                <div id="form3" class="tab-pane fade">
                    @include('orderforms.whktkdown.form', ['lead' => $lead])
                </div>
                <div id="form4" class="tab-pane fade">
                    @include('orderforms.whcross.form', ['lead' => $lead])
                </div>
            @endpermission

            @permission('car_edit')
                <div id="form5" class="tab-pane fade">
                    @include('orderforms.carwhtr.form', ['lead' => $lead])
                </div>
            @endpermission

            @permission('tr_edit')
                <div id="form6" class="tab-pane fade">
                    @include('orderforms.tr.form', ['lead' => $lead])
                </div>
                <div id="form7" class="tab-pane fade">
                    @include('orderforms.trcross.form', ['lead' => $lead])
                </div>
            @endpermission

            @permission('car_edit')
            <div id="form8" class="tab-pane fade">
                @include('orderforms.carwhcl.form', ['lead' => $lead])
            </div>
            <div id="form9" class="tab-pane fade">
                @include('orderforms.carwhtm.form', ['lead' => $lead])
            </div>
            @endpermission

            @permission('wh_edit')
                <div id="form10" class="tab-pane fade">
                    @include('orderforms.whgt.form', ['lead' => $lead])
                </div>
            @endpermission

            @permission('car_edit')
            <div id="form11" class="tab-pane fade">
                @include('orderforms.cartrwh.form', ['lead' => $lead])
            </div>
            <div id="form12" class="tab-pane fade">
                @include('orderforms.carldcrrent.form', ['lead' => $lead])
            </div>
            @endpermission
        </div>
    </div>
</div>
