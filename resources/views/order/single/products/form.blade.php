<h2>Груз</h2>
<div class="under_line"></div>
@include('order.single.products.productTemplate')

<div class="product-wrapper">
    @if(!empty($goods))
        @foreach($goods as $n => $product)
            <div data-product-id="{{ $product->id }}" style="position: relative;" class="product-form-wrapper" data-i="{{$n}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-dt-wrapper">
                                    <div style="position: relative;" class="dt-form-wrapper">
                                        <div class="row">
                                            <input type="hidden" name="product[{{$n}}][id]" value="{{$product['id']}}">
                                            <div class="col-3 offset-md-1 form-group field-productform-{{$n}}-cargo">
                                                <label for="productform-{{$n}}-cargo" class="control-label {{ $n == 0 ? '' : 'd-none' }}">Название</label>
                                                <input value="{{ $product['name'] }}" class="form-control cargo_autocomplete" type="text" name="product[{{$n}}][name]" id="productform-{{$n}}-cargo">
                                                <div class="help-block"></div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Клиент</label>
                                                    <select class="form-control" name="product[{{$n}}][client_id]">
                                                        <option value=""></option>
                                                        @foreach(\App\Models\Entities\Client::getList() as $id => $name)
                                                            <option {{ $product['client_id'] == $id ? 'selected' : '' }} value="{{$id}}">{{$name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group field-dtform-{{$n}}-0-download_type">
                                                    <label for="dtform-{{$n}}-0-download_type" class="control-label {{ $n == 0 ? '' : 'd-none' }}">Тип Загрузки</label>
                                                    <select class="form-control download_type_select" name="product[{{$n}}][download_type]" id="dtform-{{$n}}-0-download_type">
                                                        <option {{ $product->downloadTypeIsPallet() ? 'selected' : '' }} value="{{\App\Models\Entities\Goods::PALLET_DOWNLOAD_TYPE}}">Паллет</option>
                                                        <option {{ !$product->downloadTypeIsPallet() ? 'selected' : '' }} value="{{\App\Models\Entities\Goods::NAVAL_DOWNLOAD_TYPE}}">Навал</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group field-dtform-{{$n}}-0-pallet_size pallet_group {{ !$product->downloadTypeIsPallet() ? 'd-none' : '' }}">
                                                    <label for="dtform-{{$n}}-0-pallet_size" class="control-label {{ $n == 0 ? '' : 'd-none' }}">Размер Паллет</label>
                                                    <select class="form-control" name="product[{{$n}}][pallet_size]" id="dtform-{{$n}}-0-pallet_size">
                                                        <option value=""></option>
                                                        @foreach(\App\Models\Entities\Goods::palletSizesList() as $size)
                                                            <option {{ $product['pallet_size'] == $size ? 'selected' : '' }} value="{{$size}}">{{$size}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <input type="hidden" name="product[{{$n}}][status]" value="{{ $product['status'] }}">
                                    <div class="col-6">
                                        <div class="form-group field-dtform-{{$n}}-0-amount">
                                            <label for="dtform-{{$n}}-0-amount" class="control-label {{ $n == 0 ? '' : 'd-none' }}">Кол-во</label>
                                            <input value="{{ $product['amount'] }}" type="text" class="form-control" name="product[{{$n}}][amount]" id="dtform-{{$n}}-0-amount">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 form-group field-productform-{{$n}}-weight">
                                        <label for="productform-{{$n}}-weight" class="control-label {{ $n == 0 ? '' : 'd-none' }}">Масса, кг</label>
                                        <input value="{{ $product['weight'] }}" class="form-control cargo_amount" type="text" name="product[{{$n}}][weight]" id="productform-{{$n}}-weight">
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="col-3 form-group field-productform-{{$n}}-volume">
                                        <label for="productform-{{$n}}-volume" class="control-label {{ $n == 0 ? '' : 'd-none' }}">Объём, м3</label>
                                        <input value="{{ $product['volume'] }}" class="form-control cargo_amount" type="text" name="product[{{$n}}][volume]" id="productform-{{$n}}-volume">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($n > 0)
                    <a style="position: absolute;left: 15px;top:{{$n == 0 ? '25' : '0'}}px;z-index: 9;" href="#" class="untie-product-js pull-right btn btn-danger">-</a>
                @endif
            </div>
        @endforeach
    @else
        <div style="position: relative;" class="product-form-wrapper" data-i="0">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-dt-wrapper">
                                <div style="position: relative;" class="dt-form-wrapper">
                                    <div class="row">
                                        <div class="col-3 offset-md-1 form-group field-productform-0-cargo">
                                            <label for="productform-0-cargo" class="control-label">Название</label>
                                            <input class="form-control cargo_autocomplete" type="text" name="product[0][name]" id="productform-0-cargo">
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="control-label">Клиент</label>
                                                <select class="form-control" name="product[0][client_id]">
                                                    <option value=""></option>
                                                    @foreach(\App\Models\Entities\Client::getList() as $id => $name)
                                                        <option value="{{$id}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group field-dtform-0-0-download_type">
                                                <label for="dtform-0-0-download_type" class="control-label">Тип Загрузки</label>
                                                <select class="form-control download_type_select" name="product[0][download_type]" id="dtform-0-0-download_type">
                                                    <option selected value="{{\App\Models\Entities\Goods::PALLET_DOWNLOAD_TYPE}}">Паллет</option>
                                                    <option value="{{\App\Models\Entities\Goods::NAVAL_DOWNLOAD_TYPE}}">Навал</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group field-dtform-0-pallet_size pallet_group">
                                                <label for="dtform-0-0-pallet_size" class="control-label">Размер Паллет</label>
                                                <select class="form-control" name="product[0][pallet_size]" id="dtform-0-0-pallet_size">
                                                    <option value=""></option>
                                                    @foreach(\App\Models\Entities\Goods::palletSizesList() as $size)
                                                        <option value="{{$size}}">{{$size}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <input type="hidden" name="product[0][status]" value="{{ \App\Models\Entities\Goods::IN_PROCESS_STATUS }}">
                                <div class="col-6">
                                    <div class="form-group field-dtform-0-0-amount">
                                        <label for="dtform-0-0-amount" class="control-label">Кол-во</label>
                                        <input type="text" class="form-control" name="product[0][amount]" id="dtform-0-0-amount">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-3 form-group field-productform-0-weight">
                                    <label for="productform-0-weight" class="control-label">Масса, кг</label>
                                    <input class="form-control cargo_amount" type="text" name="product[0][weight]" id="productform-0-weight">
                                    <div class="help-block"></div>
                                </div>
                                <div class="col-3 form-group field-productform-0-volume">
                                    <label for="productform-0-volume" class="control-label">Объём, м3</label>
                                    <input class="form-control cargo_amount" type="text" name="product[0][volume]" id="productform-0-volume">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif
<a href="#" style="position:relative;left: 14px;" class="add_product_form-js btn btn-primary">+</a>
</div>
