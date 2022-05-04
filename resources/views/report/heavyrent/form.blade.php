<form action="{{route('heavyrentreport.update', $model->id)}}" enctype="multipart/form-data" class="heavyrent_report_form" method="post">
    @csrf
    {{ method_field('put') }}

    <div class="form-group">
        <label class="control-label"><input {{$canEdit ? '' : 'disabled'}} {{$model['toggle'] ? 'checked' : ''}} type="checkbox" name="toggle" value="1" class="jtoggler"></label>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Дата</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="date" value="{{$model['date']}}" class="form-control date_input">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Время начала операции</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="begin_time" value="{{$model['begin_time']}}" class="form-control time_input">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Время окончание операции</label>
        <div class="col-lg-8">
            <input {{$canEdit ? '' : 'disabled'}} type="text" name="end_time" value="{{$model['end_time']}}" class="form-control time_input">
        </div>
    </div>

    @if($canEdit)
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    @endif
</form>
