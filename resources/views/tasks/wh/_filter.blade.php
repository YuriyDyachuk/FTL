<h3>Фильтр</h3>

<form action="{{ route('tasks.wh') }}" method="get">
    <div class="form-group">
        <label>Дата События</label>
        <input value="{{ request('date') ?: date('d.m.Y') }}" type="text" name="date" class="date form-control">
    </div>

    <button type="submit" class="btn btn-success">Фильтр</button>

    <a href="{{ route('tasks.wh') }}" class="btn btn-primary">Сброс</a>
</form>

@section('js')
    <script>
        $(() => {
            $('.date').datepicker({
                format: "dd.mm.yyyy",
                autoClose: true,
                language: 'ru'
            });
        });
    </script>
@stop
