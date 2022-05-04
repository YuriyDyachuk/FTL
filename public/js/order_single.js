$(() => {
    var weightSliderArray = [],
        volumeSliderArray = [],
        amountSliderArray = [],
        orderId = null;

    $(document).on('click', '.bind_to_lead', function (e) {
        e.preventDefault();
        orderId = this.dataset.id;
        $('.status_field').val('2');

        $.ajax({
            url: route('order.getexportform', orderId),
            type: 'post',
            success: (res) => {
                return new Promise((resolve, reject) => {
                    $('#warehouse_cargo_modal .modal-body').html(res);
                    $('#warehouse_cargo_modal').modal();
                    resolve();
                }).then(() => {
                    enableSlider();
                });
            },
            error: () => {
                console.log('get export form ajax request failed');
            }
        });
    });

    $(document).on('click', '.submit_goods_bind', function (e) {
        e.preventDefault();
        let form = $(this).closest('form').serialize();
        $.ajax({
            url: route('order.bindsingletolead', orderId),
            type: 'post',
            data: form,
            success: (res) => {
                res = JSON.parse(res);
                location.href = route('leads.'+res.label+'.edit', res.id);
            },
            error: () => {
                console.log('bind goods to lead ajax request failed');
            }
        });
    });

    $(document).on("click", ".untie-product-js", function(e){
        e.preventDefault();
        $(this).closest('.product-form-wrapper').remove();
        //saveFormData(true);
        $('.status_field').val('1');
    });

    $(document).on("click", ".add_product_form-js", function(e){
        e.preventDefault();
        var _this = $(this),
            wrapper = _this.closest('.product-wrapper'),
            i = parseInt(wrapper.find('.product-form-wrapper').last().data('i')) + 1,
            dti = 0;

        var tmpl = $.templates("#productTemplate");
        var data = {id: i, dtid: dti};
        var html = tmpl.render(data);
        _this.before(html);
        //saveFormData(true);
        $('.status_field').val('1');
    });

    $(document).on('change', '.download_type_select', function(){
        let value = this.value;
        if(value === '1'){
            $(this).closest('.product-dt-wrapper').find('.pallet_group').addClass('d-none');
        }else{
            $(this).closest('.product-dt-wrapper').find('.pallet_group').removeClass('d-none');
        }
    });

    function enableSlider(){
        if($(".slider-amount").length > 0){
            $(".slider-amount").each((i, item) => {
                $(item).ionRangeSlider({
                    type: "single",
                    min: 1,
                    max: item.dataset.amount,
                    from: item.dataset.amount,
                    to: item.dataset.amount,
                    grid: true,
                    onChange: function (data) {
                        let newVolumeValue = (item.dataset.volume / 100 * data.from_percent).toFixed(1),
                            newWeightValue = (item.dataset.weight / 100 * data.from_percent).toFixed(1);

                        volumeSliderArray[i].update({
                            from: newVolumeValue,
                            to: newVolumeValue
                        });
                        weightSliderArray[i].update({
                            from: newWeightValue,
                            to: newWeightValue
                        });
                    },
                });
                amountSliderArray[i] = $(item).data("ionRangeSlider");
            });
        }

        if($(".slider-weight").length > 0){
            $(".slider-weight").each((i, item) => {
                $(item).ionRangeSlider({
                    type: "single",
                    min: 1,
                    step: 0.1,
                    max: item.dataset.weight,
                    from: item.dataset.weight,
                    to: item.dataset.weight,
                    grid: true,
                    onChange: function (data) {
                        let newVolumeValue = (item.dataset.volume / 100 * data.from_percent).toFixed(1),
                            newAmountValue = Math.round(item.dataset.amount / 100 * data.from_percent);
                        volumeSliderArray[i].update({
                            from: newVolumeValue,
                            to: newVolumeValue
                        });
                        amountSliderArray[i].update({
                            from: newAmountValue,
                            to: newAmountValue,
                        });
                    },
                });
                weightSliderArray[i] = $(item).data("ionRangeSlider");
            });
        }

        if($(".slider-volume").length > 0){
            $(".slider-volume").each((i, item) => {
                $(item).ionRangeSlider({
                    type: "single",
                    min: 1,
                    step: 0.1,
                    max: item.dataset.volume,
                    from: item.dataset.volume,
                    to: item.dataset.volume,
                    grid: true,
                    onChange: function (data) {
                        let newWeightValue = (item.dataset.weight / 100 * data.from_percent).toFixed(1),
                            newAmountValue = Math.round(item.dataset.amount / 100 * data.from_percent);
                        weightSliderArray[i].update({
                            from: newWeightValue,
                            to: newWeightValue
                        });
                        amountSliderArray[i].update({
                            from: newAmountValue,
                            to: newAmountValue,
                        });
                    },
                });
                volumeSliderArray[i] = $(item).data("ionRangeSlider");
            });
        }
    }

});
