<h2>{{ $model->getBlockTitle() }}</h2>

<form method="post" enctype="multipart/form-data" class="block_form">
{{--    @csrf--}}
    {{ method_field('put') }}
    <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::TRAIN_ORDER_TYPE}}">
    <input type="hidden" name="order_id" value="{{$model['order_id']}}">
    <input type="hidden" name="type" value="{{$model['type']}}">
    <input type="hidden" name="id" value="{{$model->id}}">
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Дата</label>
        <div class="col-lg-8">
            <input type="text" name="date" value="{{ $model->date }}" class="date_input form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Время</label>
        <div class="col-lg-8">
            <input type="text" name="time" value="{{ $model->time }}" class="time_input form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Город</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="city" value="{{ $model['city'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Адрес</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="address" value="{{ $model['address'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Код</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="code" value="{{ $model['code'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Наименование</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="name" value="{{ $model['name'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">ФИО</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" name="fio" value="{{ $model['fio'] }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Телефон</label>
        <div class="col-lg-8">
            <input type="text" class="form-control phone_input" name="phone" value="{{ $model['phone'] }}">
        </div>
    </div>
</form>
