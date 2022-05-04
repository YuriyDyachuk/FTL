<label><input class="jtoggler orders_to_create_manually" type="checkbox">Принудительная настройка</label>
{{--<div class="tr_orders_block_panel"></div>--}}
<table class="table table-hover table-striped table-bordered tr_orders_block">
    <thead>
    <tr>
        <th>Авто</th>
        <th>Склад</th>
        <th>ЖД</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td data-type="{{App\Models\Entities\Order::CAR_PROVIDER_FTL_NAME}}">
            <label><input value="{{App\Models\Entities\Order::CAR_PROVIDER_FTL_NAME}}" type="checkbox" {{ in_array(App\Models\Entities\Order::CAR_PROVIDER_FTL_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто Заявка: Поставщик - ФТЛ</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(App\Models\Entities\Order::CAR_PROVIDER_FTL_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{App\Models\Entities\Order::CAR_PROVIDER_FTL_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td data-type="{{App\Models\Entities\Order::WH_GETTING_NAME}}">
            <label><input value="{{App\Models\Entities\Order::WH_GETTING_NAME}}" type="checkbox" {{ in_array(App\Models\Entities\Order::WH_GETTING_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Склад Заявка: Приём</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(App\Models\Entities\Order::WH_GETTING_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{App\Models\Entities\Order::WH_GETTING_NAME}}]">
            </div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td data-type="{{App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME}}">
            <label><input value="{{App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME}}" type="checkbox" {{ in_array(App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Склад Заявка: Загрузка КТК</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{App\Models\Entities\Order::WH_KTK_DOWNLOADING_NAME}}]">
            </div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td data-type="{{App\Models\Entities\Order::CAR_TM_FTL_TR_NAME}}">
            <label><input value="{{App\Models\Entities\Order::CAR_TM_FTL_TR_NAME}}" type="checkbox" {{ in_array(App\Models\Entities\Order::CAR_TM_FTL_TR_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто Заявка: Терминал - ФТЛ - ЖД</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(App\Models\Entities\Order::CAR_TM_FTL_TR_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{App\Models\Entities\Order::CAR_TM_FTL_TR_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td data-type="{{\App\Models\Entities\Order::WH_CROSS_NAME}}">
            <label><input value="{{\App\Models\Entities\Order::WH_CROSS_NAME}}" type="checkbox" {{ in_array(\App\Models\Entities\Order::WH_CROSS_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Склад Заявка: Кроссдокинг</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(\App\Models\Entities\Order::WH_CROSS_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{\App\Models\Entities\Order::WH_CROSS_NAME}}]">
            </div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td data-type="{{App\Models\Entities\Order::CAR_TM_PROVIDER_TR_NAME}}">
            <label><input value="{{App\Models\Entities\Order::CAR_TM_PROVIDER_TR_NAME}}" type="checkbox" {{ in_array(App\Models\Entities\Order::CAR_TM_PROVIDER_TR_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто Заявка: Терминал - Поставщик - ЖД</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(App\Models\Entities\Order::CAR_TM_PROVIDER_TR_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{App\Models\Entities\Order::CAR_TM_PROVIDER_TR_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td data-type="{{\App\Models\Entities\Order::TR_NAME}}">
            <label><input value="{{\App\Models\Entities\Order::TR_NAME}}" type="checkbox" {{ in_array(\App\Models\Entities\Order::TR_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Заявка в ЖД Отдел</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(\App\Models\Entities\Order::TR_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{\App\Models\Entities\Order::TR_NAME}}]">
            </div>
        </td>
    </tr>
    <tr>
        <td data-type="{{\App\Models\Entities\Order::CAR_TR_FTL_TM_NAME}}">
            <label><input value="{{\App\Models\Entities\Order::CAR_TR_FTL_TM_NAME}}" type="checkbox" {{ in_array(\App\Models\Entities\Order::CAR_TR_FTL_TM_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто Заявка: ЖД - ФТЛ - Терминал</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(\App\Models\Entities\Order::CAR_TR_FTL_TM_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{\App\Models\Entities\Order::CAR_TR_FTL_TM_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td data-type="{{\App\Models\Entities\Order::CAR_TR_CLIENT_TM_NAME}}">
            <label><input value="{{\App\Models\Entities\Order::CAR_TR_CLIENT_TM_NAME}}" type="checkbox" {{ in_array(\App\Models\Entities\Order::CAR_TR_CLIENT_TM_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто Заявка: ЖД - Клиент - Терминал</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(\App\Models\Entities\Order::CAR_TR_CLIENT_TM_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{\App\Models\Entities\Order::CAR_TR_CLIENT_TM_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td data-type="{{\App\Models\Entities\Order::CAR_FTL_CLIENT_NAME}}">
            <label><input value="{{\App\Models\Entities\Order::CAR_FTL_CLIENT_NAME}}" type="checkbox" {{ in_array(\App\Models\Entities\Order::CAR_FTL_CLIENT_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто Заявка: ФТЛ - Клиент</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(\App\Models\Entities\Order::CAR_FTL_CLIENT_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{\App\Models\Entities\Order::CAR_FTL_CLIENT_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td data-type="{{\App\Models\Entities\Order::CAR_FTL_TM_NAME}}">
            <label><input value="{{\App\Models\Entities\Order::CAR_FTL_TM_NAME}}" type="checkbox" {{ in_array(\App\Models\Entities\Order::CAR_FTL_TM_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто Заявка: ФТЛ - Терминал</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(\App\Models\Entities\Order::CAR_FTL_TM_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{\App\Models\Entities\Order::CAR_FTL_TM_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td data-type="{{\App\Models\Entities\Order::CAR_HEAVY_RENT_NAME}}">
            <label><input value="{{\App\Models\Entities\Order::CAR_HEAVY_RENT_NAME}}" type="checkbox" {{ in_array(\App\Models\Entities\Order::CAR_HEAVY_RENT_NAME, $excludedOrders) ? 'checked' : '' }} class="jtoggler orderstocreate_checkbox" name="clientrequest[orderstocreate][]">Авто: Заказ тяж. техники</label>
            <div class="row">
                <label class="control-label col-8">Кол-во заявок</label>
                <input class="form-control col-4 orderstocreate_count" type="number" min="0" value="{{ in_array(\App\Models\Entities\Order::CAR_HEAVY_RENT_NAME, $excludedOrders) ? '1' : '0' }}" name="clientrequest[countorderstocreate][{{\App\Models\Entities\Order::CAR_HEAVY_RENT_NAME}}]">
            </div>
        </td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>

<style>
    .tr_orders_block .row{
        padding-right: 10px;
    }
</style>
