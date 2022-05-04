<div class="col-md-8">
    <h3>Отчет. Водитель</h3>

    <form action="{{route('driverreport.update', $model->id)}}" method="post" class="no_disable_form" style="margin-top: 50px">
        {{method_field('put')}}
        @csrf

        @if(!empty($driverBlock['fio']))
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">ФИО</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="fio" value="{{$model['fio']}}">
                </div>
            </div>
        @endif

        @if(!empty($driverBlock['phone']))
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Телефон</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control phone_input" name="phone" value="{{$model['phone']}}">
                </div>
            </div>
        @endif

        @if(!empty($driverBlock['passport_data']))
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Паспортные данные</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="passport_data" value="{{$model['passport_data']}}">
                </div>
            </div>
        @endif

        @if(!empty($driverBlock['number_and_date_of_vu_delivery']))
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Номер и дата выдачи ВУ</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="number_and_date_of_vu_delivery" value="{{$model['number_and_date_of_vu_delivery']}}">
                </div>
            </div>
        @endif

        @if(!empty($driverBlock['mark_and_number_of_car']))
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Марка и номер машины</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="mark_and_number_of_car" value="{{$model['mark_and_number_of_car']}}">
                </div>
            </div>
        @endif

        @if(!empty($driverBlock['trailer_num']))
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Номер прицепа</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="trailer_num" value="{{$model['trailer_num']}}">
                </div>
            </div>
        @endif

        <div class="form-group">
            <button type="submit" class="btn btn-success">Отправить</button>
        </div>
    </form>

</div>
