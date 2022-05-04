<div class="order-product-wrapper">
    @if(!empty($goods))
        <h3>Груз</h3>
        @foreach($goods as $n => $product)
            <div style="position: relative;" class="product-form-wrapper {{ $model->goodsFromOtherOrderName($product['id']) ? 'external_product' : '' }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                @if($model->goodsFromCurrentOrder($product['id']))
                                    <form style="position: relative; z-index: 999; float: left; {{ $n == 0 ? 'margin-top:30px;' : '' }}" action="{{route('ordercargo.create')}}" method="post" class="block_form">
                                        @csrf
                                        {{ method_field('put') }}
                                        <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::PRODUCT_TYPE}}">
                                        <label class="kt-checkbox">
                                            <input checked value="1" name="enabled" type="checkbox">
                                            <span></span>
                                        </label>

                                        <input type="hidden" name="goods_id" value="{{ $product['id'] }}">
                                        <input type="hidden" name="order_id" value="{{ $model->id }}">
                                        <input type="hidden" name="order_name" value="{{ $model->name }}">
                                        <input type="hidden" name="lead_id" value="{{ $model->lead_id }}">
                                        <input type="hidden" name="order_type" value="{{ $model->type }}">
                                    </form>
                                @elseif(!$model->goodsFromCurrentOrder($product['id']) && $model->goodsFromCurrentOrderName($product['id']))
{{--                                    <label style="float: left;" class="kt-checkbox">--}}
{{--                                        <input checked disabled type="checkbox">--}}
{{--                                        <span></span>--}}
{{--                                    </label>--}}
                                @else
                                    <form style="position: relative; z-index: 999; float: left; {{ $n == 0 ? 'margin-top:30px;' : '' }}" action="{{route('ordercargo.create')}}" method="post" class="block_form">
                                        @csrf
                                        {{ method_field('put') }}
                                        <input type="hidden" name="blocktype" value="{{\App\Models\Entities\Block::PRODUCT_TYPE}}">
                                        <label class="kt-checkbox">
                                            <input value="1" name="enabled" type="checkbox">
                                            <span></span>
                                        </label>

                                        <input type="hidden" name="goods_id" value="{{ $product['id'] }}">
                                        <input type="hidden" name="order_id" value="{{ $model->id }}">
                                        <input type="hidden" name="order_name" value="{{ $model->name }}">
                                        <input type="hidden" name="lead_id" value="{{ $model->lead_id }}">
                                        <input type="hidden" name="order_type" value="{{ $model->type }}">
                                    </form>
                                @endif

                                    @if($model->goodsFromCurrentOrder($product['id']) === true || $model->goodsFromCurrentOrderName($product['id']) === false)
{{--                                        <div class="col-md-6">--}}
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
                                                        <div class="col-md-4 pl-0 pr-0">
                                                            <div class="form-group">
                                                                <label class="control-label {{ $n == 0 ? '' : 'd-none' }}">Размер Паллет</label>
                                                                <select disabled class="form-control">
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
{{--                                        </div>--}}
                                    @endif
                            </div>
                            @if($model->goodsFromCurrentOrder($product['id']) === true || $model->goodsFromCurrentOrderName($product['id']) === false)
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
