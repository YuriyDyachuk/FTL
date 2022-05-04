<form class="kt-form" action="{{ route('leads.index') }}" method="get">
    <div class="kt-portlet__body">
        <h3>Фильтр</h3>
        <div class="form-group">
            <label>Дата добавления</label>
            <input value="{{ app('request')->input('created_at') }}" autocomplete="off" type="text" name="created_at" class="date_input_all form-control">
        </div>

        <div class="form-group">
            <label>Клиент</label>
            <input type="text" name="client" class="form-control" value="{{ app('request')->input('client') }}">
        </div>

        <div class="form-group">
            <label>Статус</label>
            <select name="status" class="form-control">
                <option value=""></option>
                @foreach(App\Models\Entities\EntityStatus::getStatusLabels() as $n => $label)
                    <option {{ app('request')->input('status') == $n ? 'selected' : '' }} value="{{ $n }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>КТК префикс</label>
            <input autocomplete="off" type="text" class="form-control" name="ktk_prefix" value="{{ app('request')->input('ktk_prefix') }}">
        </div>

        <div class="form-group">
            <label>КТК номер</label>
            <input autocomplete="off" type="text" class="form-control" name="ktk_num" value="{{ app('request')->input('ktk_num') }}">
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Фильтр</button>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <a href="{{ route('leads.index') }}" class="btn btn-primary">Сбросить</a>
                </div>
            </div>
        </div>
    </div>
</form>
