<div class="form-group row">
    <label class="col-lg-4 col-form-label">ФИО</label>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="report[fio]" value="{{$report['fio']}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Телефон</label>
    <div class="col-lg-8">
        <input type="text" class="form-control phone_input" name="report[phone]" value="{{$report['phone']}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Паспортные данные</label>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="report[passport_data]" value="{{$report['passport_data']}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Номер и дата выдачи ВУ</label>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="report[number_and_date_of_vu_delivery]" value="{{$report['number_and_date_of_vu_delivery']}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Марка и номер машины</label>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="report[mark_and_number_of_car]" value="{{$report['mark_and_number_of_car']}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Номер прицепа</label>
    <div class="col-lg-8">
        <input type="text" class="form-control" name="report[trailer_num]" value="{{$report['trailer_num']}}">
    </div>
</div>
