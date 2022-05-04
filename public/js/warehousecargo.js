$(() => {
    var weightSliderArray = [],
        volumeSliderArray = [],
        amountSliderArray = [];

    $(document).on('click', '.cargo_el td', function(e){
        if(!$(this).hasClass('no_modal')){
            e.preventDefault();
            let info = $(this).closest('.cargo_el').data('info');

            if(info.length > 0){
                //info = JSON.parse(info);
                let html = '';
                for(let el of info){
                    html += '<tr>' +
                        '<td><a target="_blank" href="'+route('gettingact.edit', el.getting_act_id)+'">'+el.getting_act_id+'</a></td>' +
                        '<td>'+el.weight+'</td>' +
                        '<td>'+el.volume+'</td>' +
                        '<td>'+el.amount+'</td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '</tr>';
                }
                $('#warehouse_cargo_client_requests_modal .modal-body table tbody').html(html);
                $('#warehouse_cargo_client_requests_modal').modal();
            }
        }
    });

    $(document).on('click', '.submit_cargo_export', function (e) {
        e.preventDefault();
        let form = $(this).closest('form').serialize();
        $.ajax({
            url: route('warehousecargo.exportcargo'),
            type: 'post',
            data: form,
            success: (res) => {
                res = JSON.parse(res);
                location.href = route('leads.'+res.label+'.edit', res.id);
            },
            error: () => {
                console.log('export cargo ajax request failed');
            }
        });
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



    $(document).on('click', '.open_cargos_model', function(e){
        e.preventDefault();
        let enabled = getEnabledCargos();

        if(enabled.length > 0){
            $.ajax({
                type: 'post',
                url: route('warehousecargo.getexportform'),
                data: {
                    ids: JSON.stringify(enabled)
                },
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
        }
    });

    $(document).on('change', '.cargos_checkbox', function(){
        let enabled = getEnabledCargos();

        if(enabled.length > 0){
            $('.open_cargos_model').removeClass('d-none');
        }else{
            $('.open_cargos_model').addClass('d-none');
        }
    });

    function getEnabledCargos(){
        let enabled = [];
        $('.cargos_checkbox').each((i, item) => {
            if(item.checked === true){
                enabled.push(item.value);
            }
        });

        return enabled;
    }
});
