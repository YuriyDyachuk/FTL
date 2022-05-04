@permission('car_view')
@if($lead->carLdcrRent()->exists())
    <h4>Авто: Заказ тяж. техники</h4>
    @foreach($lead->carLdcrRent as $n => $model)
        @include('orderforms.carldcrrent.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->carRqstClWh()->exists())
    <h4>Авто Заявка: Поставщик - Склад ФТЛ «Авто:К-Скл»</h4>
    @foreach($lead->carRqstClWh as $n => $model)
        @include('orderforms.carrqstclwh.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->carRqstTmWh()->exists())
    <h4>Авто Заявка: Терминал - Склад ФТЛ - ЖД Станция «Авто:КТК»</h4>
    @foreach($lead->carRqstTmWh as $n => $model)
        @include('orderforms.carrqsttmwh.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->carTrWh()->exists())
    <h4>Авто Заявка: ЖД Станция - Склад Клиента - Терминал «Авто: ЖД-С»</h4>
    @foreach($lead->carTrWh as $n => $model)
        @include('orderforms.cartrwh.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->carWhCl()->exists())
    <h4>Авто Заявка: подача Груза – со Склада ФТЛ Клиенту «Авто:Скл-К»</h4>
    @foreach($lead->carWhCl as $n => $model)
        @include('orderforms.carwhcl.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->carWhTm()->exists())
    <h4>Авто Заявка: возврат Контейнера – со Склада на Терминал «Авто:возвр КТК»</h4>
    @foreach($lead->carWhTm as $n => $model)
        @include('orderforms.carwhtm.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->carWhTr()->exists())
    <h4>Авто Заявка: со Склада на ЖД станцию «Авто: Скл-ЖД»</h4>
    @foreach($lead->carWhTr as $n => $model)
        @include('orderforms.carwhtr.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@endpermission
@permission('tr_view')
@if($lead->tr()->exists())
    @foreach($lead->tr as $n => $model)
        @include('orderforms.tr.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->trCross()->exists())
    <h4>ЖД Заявка: Кросс-докинг «ЖД:К-Д»</h4>
    @foreach($lead->trCross as $n => $model)
        @include('orderforms.trcross.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@endpermission
@permission('wh_view')
@if($lead->whCross()->exists())
    <h4>Склад Заявка: Кросс-Докинг</h4>
    @foreach($lead->whCross as $n => $model)
        @include('orderforms.whcross.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->whGt()->exists())
    <h4>Склад Заявка: Приём «Склад:П»</h4>
    @foreach($lead->whGt as $n => $model)
        @include('orderforms.whgt.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@if($lead->whKtkDown()->exists())
    <h4>Склад Заявка: Загрузка КТК «Склад:З-КТК»</h4>
    @foreach($lead->whKtkDown as $n => $model)
        @include('orderforms.whktkdown.showTable', ['model' => is_bool($model) ? [] : $model])
    @endforeach
@endif
@endpermission
