<div class="order-product-wrapper">

    @if(!empty($goods))
        <h3>Груз</h3>
        @foreach($goods as $n => $product)
{{--                        @php--}}
{{--                            $product = $product->clientRequestProduct;--}}
{{--                        @endphp--}}
            <div style="position: relative;" class="product-form-wrapper {{ $model->goodsFromOtherOrder($product['id']) ? 'external_product' : '' }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                @if($model->goodsFromCurrentOrder($product['id']))
                                    <label class="kt-checkbox" style="position: relative; z-index: 999; float: left; {{ $n == 0 ? 'margin-top:30px;' : '' }}">
                                        <input value="1" name="enabled" checked type="checkbox">
                                        <span></span>
                                    </label>
                                @else
                                    <label class="kt-checkbox" style="float: left; {{ $n == 0 ? 'margin-top:30px;' : '' }}">
                                        <input disabled name="enabled" value="1" type="checkbox">
                                        <span></span>
                                    </label>
                                @endif
                                    <div class="product-dt-wrapper">
                                        <div style="position: relative;" class="dt-form-wrapper" >
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Наименование</label>
                                                        <input disabled value="{{ $product['name'] }}" class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Тип Загрузки</label>
                                                        <select disabled class="form-control download_type_select">
                                                            <option {{ $product->downloadTypeIsPallet() ? 'selected' : '' }} value="{{\App\Models\Entities\Goods::PALLET_DOWNLOAD_TYPE}}">Паллет</option>
                                                            <option {{ !$product->downloadTypeIsPallet() ? 'selected' : '' }} value="{{\App\Models\Entities\Goods::NAVAL_DOWNLOAD_TYPE}}">Навал</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Размер Паллет</label>
                                                        <select disabled class="form-control {{ !$product->downloadTypeIsPallet() ? 'd-none' : '' }}">
                                                            <option value=""></option>
                                                            @foreach(\App\Models\Entities\Goods::palletSizesList() as $size)
                                                                <option {{ $product['pallet_size'] == $size ? 'selected' : '' }} value="{{$size}}">{{$size}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Кол-во</label>
                                            <input disabled value="{{ $product['amount'] }}" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Масса, кг</label>
                                            <input disabled value="{{ $product['weight'] }}" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Объём, м3</label>
                                            <input disabled value="{{ $product['volume'] }}" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
