@if(!empty($goods))
    <h2>Груз:</h2>
    <form>
        <div class="form-group col-3">
            <label class="control-label">Тип Сделки</label>
            <select name="lead_type" class="form-control">
                <option value="{{\App\Models\Entities\Leads::TR_TYPE}}">ЖД</option>
                <option value="{{\App\Models\Entities\Leads::CAR_TYPE}}">Авто</option>
            </select>
        </div>
        @foreach ($goods as $goodsItem)
            @include('order.single.export.table')
            @include('order.single.export.spoiler')
            <hr>
        @endforeach
        <a class="btn btn-success submit_goods_bind" href="#">Добавить в КЗ Сделки</a>
    </form>
@else
    <h3>Груз не найден</h3>
@endif
