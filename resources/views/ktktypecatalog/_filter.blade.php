<form action="{{ route('ktktypecatalog.sort') }}" method="get">
    <div class="form-group">
        <label>Название</label>
        <input type="text" class="form-control" name="name" value="{{ app('request')->input('name') }}">
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Фильтр</button>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <a href="{{ route('ktktypecatalog.index') }}" class="btn btn-primary">Сбросить</a>
            </div>
        </div>
    </div>
</form>
