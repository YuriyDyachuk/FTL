<script id="productTemplate" type="text/html">
        <div style="position: relative;" class="product-form-wrapper" data-i="@{{:id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-dt-wrapper">
                                <div style="position: relative;" class="dt-form-wrapper">
                                    <div class="row">
                                        <div class="col-3 offset-md-1 form-group field-productform-@{{:id}}-cargo">
                                            <label class="control-label d-none" for="productform-@{{:id}}-cargo">Название</label>
                                            <input type="text" class="form-control cargo_autocomplete" name="product[@{{:id}}][name]" id="productform-@{{:id}}-cargo">
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="control-label d-none">Клиент</label>
                                                <select class="form-control" name="product[@{{:id}}][client_id]">
                                                    <option value=""></option>
                                                    @foreach(\App\Models\Entities\Client::getList() as $id => $name)
                                                        <option value="{{$id}}">{{$name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group field-dtform-@{{:id}}-download_type">
                                                <label for="dtform-@{{:id}}-download_type" class="control-label d-none">Тип Загрузки</label>
                                                <select class="form-control download_type_select" name="product[@{{:id}}][download_type]" id="dtform-@{{:id}}-download_type">
                                                    <option selected value="{{\App\Models\Entities\Goods::PALLET_DOWNLOAD_TYPE}}">Паллет</option>
                                                    <option value="{{\App\Models\Entities\Goods::NAVAL_DOWNLOAD_TYPE}}">Навал</option>
                                                </select>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group field-dtform-@{{:id}}-pallet_size pallet_group">
                                                <label for="dtform-@{{:id}}-pallet_size" class="control-label d-none">Размер Паллет</label>
                                                <select class="form-control" name="product[@{{:id}}][pallet_size]" id="dtform-@{{:id}}-pallet_size">
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
                                <input type="hidden" name="product[@{{:id}}][status]" value="{{ \App\Models\Entities\Goods::IN_PROCESS_STATUS }}">
                                <div class="col-6">
                                    <div class="form-group field-dtform-@{{:id}}-amount">
                                        <label for="dtform-@{{:id}}-amount" class="control-label d-none">Кол-во</label>
                                        <input type="text" class="form-control" name="product[@{{:id}}][amount]" id="dtform-@{{:id}}-amount">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-3 form-group field-productform-@{{:id}}-weight">
                                    <label class="control-label d-none" for="productform-@{{:id}}-weight">Масса, кг</label>
                                    <input type="text" class="form-control cargo_amount" name="product[@{{:id}}][weight]" id="productform-@{{:id}}-weight">
                                    <div class="help-block"></div>
                                </div>
                                <div class="col-3 form-group field-productform-@{{:id}}-volume">
                                    <label class="control-label d-none" for="productform-@{{:id}}-volume">Объём, м3</label>
                                    <input type="text" class="form-control cargo_amount" name="product[@{{:id}}][volume]" id="productform-@{{:id}}-volume">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a style="position: absolute;left: 15px;top:0px;z-index: 9;" href="#" class="untie-product-js pull-right btn btn-danger">-</a>
        </div>
</script>
