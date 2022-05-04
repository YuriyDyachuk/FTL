<h2>Название</h2>
@include('leads.products.productTemplate', ['lead' => $lead])
@include('leads.products.dtTemplate')

<div class="product-wrapper">
    @if($lead->products()->exists())
        @foreach($lead->products as $n => $product)
            <br><br>
            <div style="position: relative;" class="product-form-wrapper" data-i="{{$n}}">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="product[{{$n}}][lead_id]" value="{{ $lead->id }}">
                        <div class="form-group field-productform-{{$n}}-cargo">
                            <label for="productform-{{$n}}-cargo" class="control-label">Название</label>
                            <input value="{{ $product['cargo'] }}" class="form-control" type="text" name="product[{{$n}}][cargo]" id="productform-{{$n}}-cargo">
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group field-productform-{{$n}}-weight">
                            <label for="productform-{{$n}}-weight" class="control-label">Масса, кг</label>
                            <input value="{{ $product['weight'] }}" class="form-control" type="text" name="product[{{$n}}][weight]" id="productform-{{$n}}-weight">
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group field-productform-{{$n}}-volume">
                            <label for="productform-{{$n}}-volume" class="control-label">Объём, м3</label>
                            <input value="{{ $product['volume'] }}" class="form-control" type="text" name="product[{{$n}}][volume]" id="productform-{{$n}}-volume">
                            <div class="help-block"></div>
                        </div>
                        <div class="product-dt-wrapper">
                            @if($product->downloadTypes()->exists())

                                    <div style="position: relative;" class="dt-form-wrapper" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group field-dtform-{{$n}}-0-download_type">
                                                    <label for="dtform-{{$n}}-0-download_type" class="control-label">Тип Загрузки</label>
                                                    <select class="form-control download_type_select" name="dt[{{$n}}][0][download_type]" id="dtform-{{$n}}-0-download_type">
                                                        <option @php echo $product->downloadTypes['download_type'] == 'pallet' ? 'selected' : '' @endphp value="pallet">Паллет</option>
                                                        <option @php echo $product->downloadTypes['download_type'] == 'naval' ? 'selected' : '' @endphp value="naval">Навал</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group field-dtform-{{$n}}-0-pallet_size">
                                                    <label for="dtform-{{$n}}-0-pallet_size" class="control-label">Размер Паллет</label>
                                                    <select class="form-control" name="dt[{{$n}}][0][pallet_size]" id="dtform-{{$n}}-0-pallet_size">
                                                        <option value=""></option>
                                                        <option @php echo $product->downloadTypes['pallet_size'] == '1200*80*1600' ? 'selected' : '' @endphp value="1200*80*1600">1200*80*1600</option>
                                                        <option @php echo $product->downloadTypes['pallet_size'] == '1200*80*1800' ? 'selected' : '' @endphp value="1200*80*1800">1200*80*1800</option>
                                                        <option @php echo $product->downloadTypes['pallet_size'] == '1200*80*20' ? 'selected' : '' @endphp value="1200*80*20">1200*80*20</option>
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group field-dtform-{{$n}}-0-amount">
                                                    <label for="dtform-{{$n}}-0-amount" class="control-label">Кол-во</label>
                                                    <input value="{{ $product->downloadTypes['amount'] }}" type="text" class="form-control" name="dt[{{$n}}][0][amount]" id="dtform-{{$n}}-0-amount">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <a style="position: absolute;right: -85px;bottom: 15px;" href="#" class="untie-dt-js pull-right btn btn-danger">-</a>
                                    </div>

                            @else
                            <div style="position: relative;" class="dt-form-wrapper" >
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group field-dtform-0-0-download_type">
                                            <label for="dtform-0-0-download_type" class="control-label">Тип Загрузки</label>
                                            <select class="form-control download_type_select" name="dt[0][0][download_type]" id="dtform-0-0-download_type">
                                                <option selected value="pallet">Паллет</option>
                                                <option value="naval">Навал</option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="pallet-data">
                                        <div class="col-sm-3">
                                            <div class="form-group field-dtform-0-0-pallet_size">
                                                <label for="dtform-0-0-pallet_size" class="control-label">Размер Паллет</label>
                                                <select class="form-control" name="dt[0][0][pallet_size]" id="dtform-0-0-pallet_size">
                                                    <option value=""></option>
                                                    <option value="1200*80*1600">1200*80*1600</option>
                                                    <option value="1200*80*1800">1200*80*1800</option>
                                                    <option value="1200*80*20">1200*80*20</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="naval-data d-none">
                                        <div class="col-sm-6">
                                            <div class="form-group field-dtform-0-0-amount">
                                                <label for="dtform-0-0-amount" class="control-label">Кол-во</label>
                                                <input type="text" class="form-control" name="dt[0][0][amount]" id="dtform-0-0-amount">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <a style="position: absolute;left: -25px;bottom: 15px;" href="#" class="add_dt_form-js btn btn-primary">+</a>
                        </div>

                    </div>
                </div>
                <a style="position: absolute;left: 50px;z-index: 999;" href="#" class="untie-product-js pull-right btn btn-danger">-</a>
            </div>
        @endforeach
    @else
        <div style="position: relative;" class="product-form-wrapper" data-i="0">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="product[0][lead_id]" value="{{ $lead->id }}">
                    <div class="form-group field-productform-0-cargo">
                        <label for="productform-0-cargo" class="control-label">Название</label>
                        <input class="form-control" type="text" name="product[0][cargo]" id="productform-0-cargo">
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-productform-0-weight">
                        <label for="productform-0-weight" class="control-label">Масса, кг</label>
                        <input class="form-control" type="text" name="product[0][weight]" id="productform-0-weight">
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-productform-0-volume">
                        <label for="productform-0-volume" class="control-label">Объём, м3</label>
                        <input class="form-control" type="text" name="product[0][volume]" id="productform-0-volume">
                        <div class="help-block"></div>
                    </div>

                    <div class="product-dt-wrapper">
                        <div style="position: relative;" class="dt-form-wrapper" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group field-dtform-0-0-download_type">
                                        <label for="dtform-0-0-download_type" class="control-label">Тип Загрузки</label>
                                        <select class="form-control download_type_select" name="dt[0][0][download_type]" id="dtform-0-0-download_type">
                                            <option selected value="pallet">Паллет</option>
                                            <option value="naval">Навал</option>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="pallet-data">
                                    <div class="col-sm-3">
                                        <div class="form-group field-dtform-0-pallet_size">
                                            <label for="dtform-0-0-pallet_size" class="control-label">Размер Паллет</label>
                                            <select class="form-control" name="dt[0][0][pallet_size]" id="dtform-0-0-pallet_size">
                                                <option value=""></option>
                                                <option value="1200*80*1600">1200*80*1600</option>
                                                <option value="1200*80*1800">1200*80*1800</option>
                                                <option value="1200*80*20">1200*80*20</option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="naval-data d-none">
                                    <div class="col-sm-6">
                                        <div class="form-group field-dtform-0-0-amount">
                                            <label for="dtform-0-0-amount" class="control-label">Кол-во</label>
                                            <input type="text" class="form-control" name="dt[0][0][amount]" id="dtform-0-0-amount">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a style="position: absolute;left: -25px;bottom: 15px;" href="#" class="add_dt_form-js btn btn-primary">+</a>
                    </div>

                </div>
            </div>
        </div>
@endif


        <a href="#" class="add_product_form-js btn btn-primary">+</a>

</div>
