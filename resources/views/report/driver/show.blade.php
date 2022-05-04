<div class="col-md-8">

    <form style="margin-top: 50px">

        <h3>Отчет. Перевозчик</h3>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Наименование</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control" name="carrier_name" value="{{$model['carrier_name']}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">ИНН</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control" name="carrier_inn" value="{{$model['carrier_inn']}}">
            </div>
        </div>

        <h3>Отчет. Водитель</h3>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">ФИО</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control" name="fio" value="{{$model['fio']}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Телефон</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control phone_input" name="phone" value="{{$model['phone']}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Паспортные данные</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control" name="passport_data" value="{{$model['passport_data']}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Номер и дата выдачи ВУ</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control" name="number_and_date_of_vu_delivery" value="{{$model['number_and_date_of_vu_delivery']}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Марка и номер машины</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control" name="mark_and_number_of_car" value="{{$model['mark_and_number_of_car']}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Номер прицепа</label>
            <div class="col-lg-8">
                <input disabled type="text" class="form-control" name="trailer_num" value="{{$model['trailer_num']}}">
            </div>
        </div>
    </form>

</div>
