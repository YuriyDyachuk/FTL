<h2>Груз</h2>

<div class="under_line"></div>
@include('gettingact.cargoTemplate', ['model' => $model])

<div class="product-wrapper">
    @if($model->cargo()->exists())
        @foreach($model->cargo as $n => $product)
            <div style="position: relative;" class="product-form-wrapper" data-i="{{$n}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5 offset-md-1">
                                <div class="product-dt-wrapper">
                                        <div style="position: relative;" class="dt-form-wrapper" >
                                            <div class="row">
                                                <div class="col-4 form-group">
                                                    <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Название</label>
                                                    <input value="{{ $product['name'] }}" class="form-control cargo_autocomplete" type="text" name="cargo[{{$n}}][name]">
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Тип Загрузки</label>
                                                        <select class="form-control download_type_select" name="cargo[{{$n}}][download_type]">
                                                            <option {{ $product['download_type'] == 'pallet' ? 'selected' : '' }} value="pallet">Паллет</option>
                                                            <option {{ $product['download_type'] == 'naval' ? 'selected' : '' }} value="naval">Навал</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group pallet_group">
                                                        <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Размер Паллет</label>
                                                        <select class="form-control" name="cargo[{{$n}}][pallet_size]">
                                                            <option value=""></option>
                                                            <option {{ $product['pallet_size'] == '1200*80*1600' ? 'selected' : '' }} value="1200*80*1600">1200*80*1600</option>
                                                            <option {{ $product['pallet_size'] == '1200*80*1800' ? 'selected' : '' }} value="1200*80*1800">1200*80*1800</option>
                                                            <option {{ $product['pallet_size'] == '1200*80*20' ? 'selected' : '' }} value="1200*80*20">1200*80*20</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <input type="hidden" name="cargo[{{$n}}][cargo_type_id]" value="{{ $product['cargo_type_id'] }}" class="cargo_type_id_input">
                                    <input type="hidden" name="cargo[{{$n}}][status]" value="{{ \App\Models\Entities\GettingActCargo::IN_THE_WAREHOUSE_STATUS }}">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Кол-во</label>
                                            <input value="{{ $product['amount'] }}" type="text" class="form-control" name="cargo[{{$n}}][amount]">
                                        </div>
                                    </div>
                                    <div class="col-3 form-group">
                                        <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Масса, кг</label>
                                        <input required value="{{ $product['weight'] }}" class="form-control cargo_amount" type="text" name="cargo[{{$n}}][weight]">
                                    </div>
                                    <div class="col-3 form-group">
                                        <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Объём, м3</label>
                                        <input required value="{{ $product['volume'] }}" class="form-control cargo_amount" type="text" name="cargo[{{$n}}][volume]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a style="position: absolute;top: {{$n == 0 ? '25' : '0'}}px;z-index: 9;" href="#" class="untie-product-js pull-left btn btn-danger">-</a>
            </div>
        @endforeach
    @else
        <div style="position: relative;" class="product-form-wrapper" data-i="0">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5 offset-md-1">
                            <div class="product-dt-wrapper">
                                <div style="position: relative;" class="dt-form-wrapper">
                                    <div class="row">
                                        <div class="col-4 form-group">
                                            <label class="control-label">Название</label>
                                            <input class="form-control cargo_autocomplete" type="text" name="cargo[0][name]">
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label class="control-label">Тип Загрузки</label>
                                                <select class="form-control download_type_select" name="cargo[0][download_type]">
                                                    <option selected value="pallet">Паллет</option>
                                                    <option value="naval">Навал</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group pallet_group">
                                                <label class="control-label">Размер Паллет</label>
                                                <select class="form-control" name="cargo[0][pallet_size]">
                                                    <option value=""></option>
                                                    <option value="1200*80*1600">1200*80*1600</option>
                                                    <option value="1200*80*1800">1200*80*1800</option>
                                                    <option value="1200*80*20">1200*80*20</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <input type="hidden" name="cargo[0][cargo_type_id]" class="cargo_type_id_input">
                                <input type="hidden" name="cargo[0][status]" value="{{ \App\Models\Entities\GettingActCargo::IN_THE_WAREHOUSE_STATUS }}">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label">Кол-во</label>
                                        <input type="text" class="form-control" name="cargo[0][amount]">
                                    </div>
                                </div>
                                <div class="col-4 form-group">
                                    <label class="control-label">Масса, кг</label>
                                    <input required class="form-control cargo_amount" type="text" name="cargo[0][weight]">
                                </div>
                                <div class="col-4 form-group">
                                    <label class="control-label">Объём, м3</label>
                                    <input required class="form-control cargo_amount" type="text" name="cargo[0][volume]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <a href="#" class="add_product_form-js btn btn-primary">+</a>

</div>
