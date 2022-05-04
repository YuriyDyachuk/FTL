<form action="{{ route('clientrequests.tr.index') }}" method="get">
    <div class="form-group">
        <input type="text" placeholder="Поиск..." name="q" value="{{request()->input('q')}}" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Поиск</button>
    </div>

</form>
