<script id="dtTemplate" type="text/html">
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
                        <input type="text" class="form-control" name="dt[{{:id}}][amount]" id="dtform-{{:id}}-amount">
                        <div class="help-block"></div>
                    </div>
                </div>
            </div>
        </div>
        <a style="position: absolute;right: -85px;bottom: 15px;" href="#" class="untie-dt-js pull-right btn btn-danger">-</a>
    </div>
</script>
