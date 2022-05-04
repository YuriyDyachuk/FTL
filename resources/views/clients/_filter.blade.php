<form action="{{ route('clients.index') }}" method="get">
    <div class="form-group">
        <input placeholder="Поиск..." name="q" type="text" class="form-control" value="{{ request('q') }}">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Поиск</button>
    </div>
</form>
