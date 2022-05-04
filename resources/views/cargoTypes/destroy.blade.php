<form onsubmit="return confirm('Вы подтверждаете удаление?')"  action="{{route('cargotypes.destroy', ['cargotype' => $model])}}" method="post">
    @csrf
    {{ method_field('delete') }}
    <button type="submit" class="btn btn-danger">Удвлить</button>
</form>
