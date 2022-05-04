<script id="cargoTemplate" type="text/html">
    <div style="position: relative;" class="product-form-wrapper" data-i="@{{:id}}">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5 offset-md-1">
                        <div class="product-dt-wrapper">
                            <div style="position: relative;" class="dt-form-wrapper" >
                                <div class="row">
                                    <div class="col-4 form-group">
                                        <label class="control-label d-none">Название</label>
                                        <input type="text" class="form-control cargo_autocomplete" name="cargo[@{{:id}}][name]">
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label class="control-label d-none">Тип Загрузки</label>
                                            <select class="form-control download_type_select" name="cargo[@{{:id}}][download_type]">
                                                <option selected value="pallet">Паллет</option>
                                                <option value="naval">Навал</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 pallet-data">
                                        <div class="form-group pallet_group">
                                            <label class="control-label d-none">Размер Паллет</label>
                                            <select class="form-control" name="cargo[@{{:id}}][pallet_size]">
                                                <option value=""></option>
                                                <option value="1200*80*1600">1200*80*1600</option>
                                                <option value="1200*80*1800">1200*80*1800</option>
                                                <option value="1200*80*20">1200*80*20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--                            <a style="position: absolute;right: -85px;bottom: 25px;" href="#" class="untie-dt-js pull-right btn btn-danger">-</a>-->
                            </div>
                            <!--                                <a style="position: absolute;right: -40px;bottom: 25px;" href="#" class="add_dt_form-js btn btn-primary">+</a>-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <input type="hidden" name="cargo[@{{:id}}][cargo_type_id]" class="cargo_type_id_input">
                            <input type="hidden" name="cargo[@{{:id}}][status]" value="{{ \App\Models\Entities\GettingActCargo::IN_THE_WAREHOUSE_STATUS }}">

                            <div class="col-lg-4 form-group">
                                <label class="control-label d-none">Кол-во</label>
                                <input type="text" class="form-control" name="cargo[@{{:id}}][amount]">
                            </div>

                            <div class="col-4 form-group">
                                <label class="control-label d-none">Масса, кг</label>
                                <input required type="text" class="form-control cargo_amount" name="cargo[@{{:id}}][weight]">
                            </div>
                            <div class="col-4 form-group">
                                <label class="control-label d-none">Объём, м3</label>
                                <input required type="text" class="form-control cargo_amount" name="cargo[@{{:id}}][volume]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a style="position: absolute;top: 0px; z-index: 9;" href="#" class="untie-product-js pull-right btn btn-danger">-</a>
    </div>
</script>
