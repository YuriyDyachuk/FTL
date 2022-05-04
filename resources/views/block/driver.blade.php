<div class="col-md-6">
    <h3>{{ $model->getBlockTitle() }}</h3>
</div>
<form method="post" enctype="multipart/form-data" class="block_form">
    {{ method_field('put') }}
    <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::DRIVER_TYPE}}">
    <input type="hidden" name="id" value="{{$model->id}}">
    <div class="col-md-12">
        <div class="form-group row">
            <p class="col-lg-12">Прошу предоставить данные на водителя до даты <span style="width:90px;display:inline-block;margin: 0 5px;"><input style="width: 100%;" type="text" class="date_input form-control" name="date" value="{{$model['date']}}"></span>г. до времени
                <span style="width:60px;display:inline-block;margin: 0 5px;"><input style="width: 100%;" type="text" class="form-control time_input" placeholder="__:__" name="time" value="{{$model['time']}}"></span></p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="kt-checkbox-list">
            <label class="kt-checkbox">
                ФИО <input type="checkbox" class="form-control" name="fio" value="1" {{ !empty($model['fio']) ? 'checked' : '' }}>
                <span></span>
            </label>
            <label class="kt-checkbox">
                Телефон <input type="checkbox" class="form-control" name="phone" value="1" {{ !empty($model['phone']) ? 'checked' : '' }}>
                <span></span>
            </label>
            <label class="kt-checkbox">
                Паспортные данные <input type="checkbox" class="form-control" name="passport_data" value="1" {{ !empty($model['passport_data']) ? 'checked' : '' }}>
                <span></span>
            </label>
            <label class="kt-checkbox">
                Номер и дата выдачи ВУ <input type="checkbox" class="form-control" name="number_and_date_of_vu_delivery" value="1" {{ !empty($model['number_and_date_of_vu_delivery']) ? 'checked' : '' }}>
                <span></span>
            </label>
            <label class="kt-checkbox">
                Марка и номер машины <input type="checkbox" class="form-control" name="mark_and_number_of_car" value="1" {{ !empty($model['mark_and_number_of_car']) ? 'checked' : '' }}>
                <span></span>
            </label>
            <label class="kt-checkbox">
                Номер прицепа <input type="checkbox" class="form-control" name="trailer_num" value="1" {{ !empty($model['trailer_num']) ? 'checked' : '' }}>
                <span></span>
            </label>
        </div>
    </div>
</form>
