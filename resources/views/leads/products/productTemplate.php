<script id="productTemplate" type="text/html">
        <div style="position: relative;" class="product-form-wrapper" data-i="{{:id}}">
            <div class="row">
                <br><br>
                <div class="col-md-12">
                    <input type="hidden" name="product[{{:id}}][lead_id]" value="<?=$lead->id?>">
                    <div class="form-group field-productform-{{:id}}-cargo">
                        <label for="productform-{{:id}}-cargo">Название</label>
                        <input type="text" class="form-control" name="product[{{:id}}][cargo]" id="productform-{{:id}}-cargo">
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-productform-{{:id}}-weight">
                        <label for="productform-{{:id}}-weight">Масса, кг</label>
                        <input type="text" class="form-control" name="product[{{:id}}][weight]" id="productform-{{:id}}-weight">
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-productform-{{:id}}-volume">
                        <label for="productform-{{:id}}-volume">Объём, м3</label>
                        <input type="text" class="form-control" name="product[{{:id}}][volume]" id="productform-{{:id}}-volume">
                        <div class="help-block"></div>
                    </div>

                    <div class="product-dt-wrapper">
                        <div style="position: relative;" class="dt-form-wrapper" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group field-dtform-{{:id}}-download_type">
                                        <label for="dtform-{{:id}}-download_type" class="control-label">Тип Загрузки</label>
                                        <select class="form-control download_type_select" name="dt[{{:id}}][download_type]" id="dtform-{{:id}}-download_type">
                                            <option selected value="pallet">Паллет</option>
                                            <option value="naval">Навал</option>
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="pallet-data">
                                    <div class="col-sm-3">
                                        <div class="form-group field-dtform-{{:id}}-pallet_size">
                                            <label for="dtform-{{:id}}-pallet_size" class="control-label">Размер Паллет</label>
                                            <select class="form-control" name="dt[{{:id}}][pallet_size]" id="dtform-{{:id}}-pallet_size">
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
                                        <div class="form-group field-dtform-{{:id}}-amount">
                                            <label for="dtform-{{:id}}-amount" class="control-label">Кол-во</label>
                                            <input type="text" class="form-control" name="dt[{{:id}}][0][amount]" id="dtform-{{:id}}-amount">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--                            <a style="position: absolute;right: -85px;bottom: 15px;" href="#" class="untie-dt-js pull-right btn btn-danger">-</a>-->
                        </div>
                        <a style="position: absolute;left: -25px;bottom: 15px;" href="#" class="add_dt_form-js btn btn-primary">+</a>
                    </div>
                </div>

            </div>

            <a style="position: absolute;left: 50px;z-index: 999;" href="#" class="untie-product-js pull-right btn btn-danger">-</a>
        </div>

</script>
