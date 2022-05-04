<div class="form-group row">
    <label class="col-lg-4 col-form-label">Ответственный Сотрудник</label>
    <div class="col-lg-1 hint">
        @include('partials.title', ['text' => App\Title::get()['orderForm']['responsibleUser']])
    </div>
    <div class="col-lg-7">
        <select name="responsible_user_id" class="form-control order_responsible_user_select">
            <option value=""></option>
            @foreach(App\User::findByRolenames(['wh_loader', 'wh_chief']) as $item)
                <option {{ $item->id == $order['responsible_user_id'] ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
</div>
