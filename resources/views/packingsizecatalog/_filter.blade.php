<form action="{{ route('packingsizecatalog.sort') }}" method="get">
    <div class="form-group">
        <label>Размер</label>
        <input type="text" class="form-control" name="size" value="{{ app('request')->input('size') }}">
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Фильтр</button>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <a href="{{ route('packingsizecatalog.index') }}" class="btn btn-primary">Сбросить</a>
            </div>
        </div>
    </div>
</form>
