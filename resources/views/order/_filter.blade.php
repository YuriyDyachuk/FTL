<form action="{{$route}}" method="get">
    <div class="form-group">
        <input placeholder="Поиск..." type="text" name="q" class="form-control" value="{{ request('q') }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Поиск</button>
    </div>
</form>
