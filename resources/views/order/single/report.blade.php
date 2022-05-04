<form action="{{ route('order.report', $model) }}" method="post" class="no_disable_form">
    {{ method_field('put') }}
    @csrf
    <div class="col-md-6">
        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Дата</label>
            <div class="col-lg-8">
                <input type="text" name="date" value="{{ $model['date'] ?: date('d.m.Y') }}" class="date_input form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Время</label>
            <div class="col-lg-8">
                <input type="text" name="time" value="{{ $model['time'] ?: date('H:i')}}" class="time_input form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Клиент</label>
            <div class="col-lg-8">
                <select class="clients_select form-control" name="client_id">
                    <option value=""></option>
                    @foreach($order->getGoodsClients() as $id => $name)
                        <option {{ $id == $model['client_id'] ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Поставщик</label>
            <div class="col-lg-8">
                <input type="text" name="provider_name" value="{{ $model['provider_name'] }}" class="form-control provider_input">
            </div>
        </div>
    </div>

    @include('order.single.products.form', ['goods' => $order->goods])

    <div class="form-group">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>

</form>

<style>
    .add_product_form-js{
        display: none;
    }
</style>
