window.saveFormData = function(displayNotify = false, reload = false){
    //  let form = $('#clientrequestsform').serialize();
    let uri = route('clientrequests.tr.validateandsave');
    let totalWeight = 0,
        totalVolume = 0;
    $('.goods_weight').map((i, el) => totalWeight += parseFloat(el.value));
    $('.goods_volume').map((i, el) => totalVolume += parseFloat(el.value));

    totalWeight = parseFloat((totalWeight).toFixed(2));

    if($('.unl_on_select')[0].selectedOptions[0].value === '1'){
        $(".ktk-slider-weight").val(totalWeight);
        $(".ktk-slider-volume").val(totalVolume);
        enableKtkSlider({totalWeight: totalWeight, totalVolume: totalVolume});
    }


    $.ajax({
        dataType:'json',
        async:true,
        type:'post',
        processData: false,
        contentType: false,
        data: new FormData($("#clientrequestsform")[0]),
        url: uri,
        // async: async,
        //   type: 'put',
        //   data: form,
        success: function(res){
            if(displayNotify === true){
                if(res === 1){
                    let statusValue = $('.client_request_status_field').val();
                    $('.client_request_set_order_status').removeClass('active_status');
                    $('.client_request_set_order_status[data-status="'+statusValue+'"]').addClass('active_status');
                    if(reload === true){
                        location.reload();
                    }
                    $.notify({
                            message: 'Сохранено'
                        },{
                            type: 'success'
                        });
                }else{
                    Object.values(res).forEach(function(item){
                        $.notify({
                            message: item[0]
                        },{
                            type: 'warning'
                        });
                    });
                }
            }
        },
        error: function(){
            $.notify({
                    message: 'Ошибка сохранения'
                },{
                    type: 'danger'
                });
        }
    });
};

$(function(){

    function runCargoAutocomplete(){
        $('.cargo_autocomplete').autocomplete({
            serviceUrl: route('cargotypes.autocompletelist'),
            type: 'post',
            dataType: 'json',
            params: {
                client: $('.client_input').val()
            },
            onSelect: function (suggestion) {
                cargoTypeSelected(suggestion.data, this);
            },
            transformResult: function(response) {
                return {
                    suggestions: $.map(response, function(dataItem) {
                        return { value: dataItem.value, data: dataItem.data, client: dataItem.client_id, provider: dataItem.provider_name };
                    })
                };
            },
        });
    }


    function cargoTypeSelected(value, element) {
        let formWrapper = $(element).closest('.product-form-wrapper');
        $.ajax({
            type: 'post',
            url: route('gettingact.getcargotypefields'),
            data: {
                id: value
            },
            success: (res) => {
                res = res[0];
                res.cargo_type_id = res.id;

                console.log({
                    cargoTypeSelected: res
                });

                $(formWrapper).find('input, select').each((i, item) => {
                    let fieldName = item.name.split('[').slice(-1)[0].replace(']', '');
                    for(let field in res){
                        if(fieldName === 'from_warehouse_cargo'){
                            $(item).val('1');
                        }
                        if(fieldName === field){
                            $(item).val(res[field]).prop('readonly', true);
                            if(item.localName === 'select'){
                                $(item).find('option').each((o, option) => {
                                    if(option.value.length > 0 && option.value !== res[field]){
                                        $(option).remove();
                                    }
                                });
                            }
                        }
                    }
                    $('.download_type_select').trigger('change');
                });
            },
            error: () => {
                console.log('get cargo type fields ajax request failed');
            }
        });
    }

    $(document).on('change', '.download_type_select', function(){
        let value = this.value;
        if(value === '1'){
            $(this).closest('.product-dt-wrapper').find('.pallet_group').addClass('d-none');
        }else{
            $(this).closest('.product-dt-wrapper').find('.pallet_group').removeClass('d-none');
        }
    });

    $('.product-form-wrapper.from_warehouse_cargo').each((i, item) => {
        $(item).find('input').prop('readonly', true);
        $(item).find('select').each((s, select) => {
            $(select).find('option:not(:selected)').addClass('d-none');
        });
    });

    var saveFormDataEnabled = true;

    var weightSliderArray = [],
        volumeSliderArray = [],
        amountSliderArray = [],
        ktkWeightSliderArray = [],
        ktkVolumeSliderArray = [],
        clId = [];

    $(document).on('click', '.cargo_import_to_client_request', function (e) {
        e.preventDefault();
        clId = this.dataset.id;
        $('#cl_warehouse_cargo_modal').modal();
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

    $(document).on('click', '.open_cargos_model', function(e){
        e.preventDefault();
        let enabled = getEnabledCargos();

        if(enabled.length > 0){
            $.ajax({
                type: 'post',
                url: route('clientrequests.tr.getimportform'),
                data: {
                    ids: JSON.stringify(enabled)
                },
                success: (res) => {
                    return new Promise((resolve, reject) => {
                        $('#cl_warehouse_cargo_modal .modal-body').html(res);
                        $('#cl_warehouse_cargo_modal').modal();
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

    $(document).on('click', '.submit_cargo_export', function (e) {
        e.preventDefault();
        let form = $('#client_request_import_cargo_form').serialize();
        $.ajax({
            url: route('clientrequests.tr.importcargo'),
            type: 'post',
            data: {
                id: clId,
                form: form
            },
            success: (res) => {
                saveFormDataEnabled = false;
                location.reload();
            },
            error: () => {
                console.log('import cargo ajax request failed');
            }
        });
    });

    function enableSlider(){
        if($(".slider-amount").length > 0){
            $(".slider-amount").each((i, item) => {
                $(item).ionRangeSlider({
                    type: "single",
                    step: 0.1,
                    min: 1,
                    max: item.value,
                    from: item.value,
                    to: item.value,
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

    const pointsType = {
        provider: 1,
        ftl: 2,
        tr: 3
    };


    const orders = {
        car:{
            heavyRent: 1,
            providerFtl: 2,
            tmFtlTr: 3,
            tmProviderTr: 4,
            trFtlTm: 5,
            trClientTm: 6,
            ftlClient: 7,
            ftlTm: 8
        },
        tr: {
            tr: 10
        },
        wh: {
            cross: 11,
            getting: 12,
            ktkDownloading: 13
        }
    };



    function pointHandler(point){
        let pointValue = +point.selectedOptions[0].value;

        //console.log({valType: typeof pointValue, typesType: typeof pointsType.ftl});
        //setTimeout(() => {
            switch (pointValue) {
                case pointsType.provider:
                    if(orderIsEnabled(orders.car.tmProviderTr)){
                        incrementOrder(orders.car.tmProviderTr);
                        //toggleOrder(orders.car.providerFtl, false);
                        //toggleOrder(orders.car.tmFtlTr, false);
                        //toggleOrder(orders.wh.getting);
                        //toggleOrder(orders.wh.ktkDownloading, false);
                    }else{
                        //toggleOrder(orders.car.tmProviderTr, false);
                        enableOrder(orders.car.providerFtl);
                        incrementOrder(orders.car.providerFtl);
                        //toggleOrder(orders.car.tmFtlTr);
                        //toggleOrder(orders.wh.getting);
                        enableOrder(orders.wh.getting);
                        incrementOrder(orders.wh.getting);
                        //toggleOrder(orders.wh.ktkDownloading);
                    }
                    break;
                case pointsType.ftl:
                    enableOrder(orders.wh.getting);
                    incrementOrder(orders.wh.getting);
                    break;
            }
        //}, 5000);
    }

    function pointsLoop(){
        $('.from_select').each((i, item) => {
            if(!$(item).hasClass('from_select_0')){
                pointHandler(item);
            }
        });
    }


    function updateNotZeroPoint(point){
        let pointValue = +point.selectedOptions[0].value;
        switch (pointValue) {
            case pointsType.provider:
                if(orderIsEnabled(orders.car.tmProviderTr)){
                    incrementOrder(orders.car.tmProviderTr);
                }else{
                    enableOrder(orders.car.providerFtl);
                    incrementOrder(orders.car.providerFtl);
                    enableOrder(orders.wh.getting);
                    incrementOrder(orders.wh.getting);
                }
                break;
            case pointsType.ftl:
                 enableOrder(orders.wh.getting);
                 incrementOrder(orders.wh.getting);
                break;
        }
    }

    $(document).on('change', '.from_select', function(){
        let firstToSelectValue = $('.to_select_0')[0].selectedOptions[0].value;
        if(!$(this).hasClass('from_select_0') && firstToSelectValue.length > 0){
            updateNotZeroPoint(this);
        }
    });

    function enableOrder(orderName){
        let orderTd = $('td[data-type="'+orderName+'"]'),
            checkbox = $(orderTd).find('input[type="checkbox"]');

        checkbox[0].checked = true;
    }

    function incrementOrder(orderName, c = 1)
    {
        enableOrder(orderName);
        let orderTd = $('td[data-type="'+orderName+'"]');
        let input = $(orderTd).find('.orderstocreate_count')[0];
        input.value = +input.value + c;
    }

    function decrementOrder(orderName, c = 1)
    {
        let orderTd = $('td[data-type="'+orderName+'"]');
        let input = $(orderTd).find('.orderstocreate_count')[0];
        if(+input.value > 0){
            input.value = +input.value - c;
        }
    }


    function toggleOrder(orderName, enabled = true){
        //alert(orderName + ' - ' + enabled);
        let orderTd = $('td[data-type="'+orderName+'"]');
        let checkbox = $(orderTd).find('input[type="checkbox"]');
        let countInput = $(orderTd).find('.orderstocreate_count')[0];

        checkbox[0].checked = enabled;

        if(checkbox[0].checked === true){
            countInput.value = 1;
        }else{
            countInput.value = 0;
        }

    }

    function orderIsEnabled(orderName){
        let orderTd = $('td[data-type="'+orderName+'"]');
        let checkbox = $(orderTd).find('input[type="checkbox"]');

        return checkbox[0].checked;
    }

    function orderCheckboxChangedHandler(orderCheckbox){
        //alert();
        let checked = orderCheckbox.checked,
            ordersToCreateManuallyChecked = $('.orders_to_create_manually')[0].checked,
            checkboxValue = +orderCheckbox.value;

        let fromSelectPoints = [];
        $('.from_select').each((i, item) => {
            fromSelectPoints.push(+item.selectedOptions[0].value);
        });

        console.log({fromSelectPoints: fromSelectPoints});

        if(ordersToCreateManuallyChecked === false){
            $('.from_select').each((i, item) => {
                let pointValue = +item.selectedOptions[0].value;
                switch (pointValue) {
                    case pointsType.provider:
                        //alert('provider');
                        if(checkboxValue === orders.car.tmProviderTr){
                            toggleOrder(orders.car.tmProviderTr, checked);
                            toggleOrder(orders.car.providerFtl, !checked);
                            toggleOrder(orders.car.tmFtlTr, !checked);
                            if(!fromSelectPoints.includes(pointsType.ftl)){
                                toggleOrder(orders.wh.getting, !checked);
                            }

                            toggleOrder(orders.wh.ktkDownloading, !checked);
                        }else if(checkboxValue === orders.car.trClientTm){
                            toggleOrder(orders.car.trClientTm, checked);
                            toggleOrder(orders.car.trFtlTm, !checked);
                            toggleOrder(orders.car.ftlClient, !checked);
                        }else if ([orders.car.providerFtl, orders.car.tmFtlTr, orders.wh.getting, orders.wh.ktkDownloading].includes(checkboxValue)){

                            toggleOrder(orders.car.tmProviderTr, !checked);
                            toggleOrder(orders.car.providerFtl, checked);
                            toggleOrder(orders.car.tmFtlTr, checked);
                            if(!fromSelectPoints.includes(pointsType.ftl)){
                                toggleOrder(orders.wh.getting, checked);
                            }

                            toggleOrder(orders.wh.ktkDownloading, checked);
                        }else{
                            toggleOrder(checkboxValue, checked);
                        }
                        break;
                    case pointsType.ftl:
                       // alert('ftl');
                        toggleOrder(orders.wh.getting, checked);
                        incrementOrder(orders.wh.getting);
                     //   alert('ftl2');
                        break;
                }
            });
        }else{
            toggleOrder(checkboxValue, checked);
        }

    }

    $(document).on('change', '.orders_to_create_manually', function(){
        if(this.checked === false){
            $('.from_select_0').trigger('change');
        }
    });

    $('.client_request_set_order_status').last().addClass('d-none');

    setTimeout(() => {
        if($('.client_request_status_field').val() === '3'){
            $('input, select, textarea').attr('disabled', true);
            $('.btn').addClass('d-none');
            $('.back_to_lead_link').removeClass('d-none');
            $('.client_request_status_btns .btn').removeClass('d-none');
            $('.client_request_status_btns input').attr('disabled', false);
        }
    }, 1000);

    $(document).on('click', '.client_request_status_field', function () {
        saveFormData(true, true);
    });

    function checkAb(){
        let firstVal = +$('.from_select_0')[0].selectedOptions[0].value,
            secondVal = +$('.to_select_0')[0].selectedOptions[0].value;
        if(firstVal > 0 && secondVal > 0){
            let firstTable = '',
                secondTable = '';
            if(firstVal === pointsType.provider){
                firstTable = 'prwh';
            }else if(firstVal === pointsType.ftl){
                firstTable = 'ftl';
            }else if(firstVal === pointsType.tr){
                firstTable = 'tr';
            }

            if(secondVal === pointsType.provider){
                secondTable = '_prwh';
            }else if(secondVal === pointsType.ftl){
                secondTable = '_ftl';
            }else if(secondVal === pointsType.tr){
                secondTable = '_tr';
            }

            let tableRes = firstTable+secondTable;
           // $('.client_request_set_order_status').last().removeClass('d-none').attr('data-value', tableRes);

            let url = route('clientrequests.tr.pickorders'),
            value = {
                type: tableRes
            };

            $.ajax({
                type: 'post',
                url: url,
                data: value,
                async: false,
                success: (res) => {
                    return new Promise(function (resolve, reject) {
                        $('.orders_to_create_block').html(res);
                        $('.jtoggler').jtoggler();
                        $('.create_orders_from_cl_request').removeClass('d-none');
                        resolve();
                    }).then(function(){
                        pointsLoop();
                    });
                },
                error: () => console.log('clientrequests.pickorders ajax request failed')
            });
        }else{
         //   $('.client_request_set_order_status').last().addClass('d-none');
            $('.orders_to_create_block').html('');
            $('.create_orders_from_cl_request').addClass('d-none');
        }
    }

    checkAb();

    $(document).on('change', '.from_select_0, .to_select_0', function () {
        checkAb();
    });

    let orderRadioButton = $('.order_radio_btn');
    let clientRequestsForm = $('#clientrequestsform').serializeArray();
    let orderRadioButtonFromForm = clientRequestsForm.filter((el)=> el.name === 'orders_type');
 //   console.log(orderRadioButtonFromForm);

    let checkKtkSize = () => {
        let value = $('.cont_size_select')[0].selectedOptions[0].value;
        if(value.length > 0){
            $.ajax({
                url: route('clientrequests.tr.getktktypeweightdata'),
                type: 'post',
                data: {
                    type: value
                },
                success: (res) => {
                    res = JSON.parse(res);
                    $('.ktk-slider-weight')[0].dataset.weight = $('.ktk-slider-volume')[0].dataset.weight = res.weight;
                    $('.ktk-slider-weight')[0].dataset.volume = $('.ktk-slider-volume')[0].dataset.volume = res.volume;
                    enableKtkSlider({weight: res.weight, volume: res.volume});
                    $('.ktk_spoiler_group').removeClass('d-none');
                },
                error: () => {
                    console.log('get ktk type weight data ajax request failed');
                }
            });
        }else{
            $('.ktk_spoiler_group').addClass('d-none');
        }
    };
    checkKtkSize();

    $(document).on('change', '.cont_size_select', function(){
        checkKtkSize();
    });

    window.enableKtkSlider = function(options = {}){
        if($(".ktk-slider-weight").length > 0){
            let weightInput = $(".ktk-slider-weight")[0];
            $(".ktk-slider-weight").ionRangeSlider({
                block: true,
                skin: "round",
                type: "single",
                min: 0.01,
                step: 0.1,
                max: weightInput.dataset.weight,
                from: weightInput.value ?? weightInput.dataset.weight,
                grid: true,
                onChange: function (data) {
                    let newVolumeValue = (weightInput.dataset.volume / 100 * data.from_percent).toFixed(2);
                    ktkVolumeSliderArray.update({
                        from: newVolumeValue,
                        to: newVolumeValue
                    });
                },
            });
            ktkWeightSliderArray = $(".ktk-slider-weight").data("ionRangeSlider");
        }

        if($(".ktk-slider-volume").length > 0){
            let volumeInput = $(".ktk-slider-volume")[0];
            $(".ktk-slider-volume").ionRangeSlider({
                block: true,
                skin: "round",
                type: "single",
                min: 0.01,
                step: 0.1,
                max: volumeInput.dataset.volume,
                from: volumeInput.value ?? volumeInput.dataset.volume,
                grid: true,
                onChange: function (data) {
                    let newWeightValue = (volumeInput.dataset.weight / 100 * data.from_percent).toFixed(2);
                    ktkWeightSliderArray.update({
                        from: newWeightValue,
                        to: newWeightValue
                    });
                },
            });
            ktkVolumeSliderArray = $(".ktk-slider-volume").data("ionRangeSlider");
        }


        if(options.weight !== undefined){
            ktkWeightSliderArray.update({
                max: options.weight,
            });
        }

        if(options.totalWeight !== undefined){
            ktkWeightSliderArray.update({
                from: options.totalWeight,
            });
        }


        if(options.volume !== undefined){
            ktkVolumeSliderArray.update({
                max: options.volume,
            });
        }

        if(options.totalVolume !== undefined){
            ktkVolumeSliderArray.update({
                from: options.totalVolume,
            });
        }

    };

    $(document).on('change', '.cont_type_select', function(){
        //console.log(this.selectedOptions[0].value);
        if(this.selectedOptions[0].value === 'Рефрижератор'){
            $(this).closest('.cont_block').find('.temp_mode_block').removeClass('d-none');
        }else{
            $(this).closest('.cont_block').find('.temp_mode_block').addClass('d-none').find('input').val('');
        }
    });

    $(document).on('change', ':file', function(){
        saveFormData(true, true);
    });

    $(document).on('change', '.from_select, .to_select', function (){
        let val = this.selectedOptions[0].value;

        if(val === '2'){
            $(this).closest('.wrapper_block').find('.city_input').val('Подольск');
            $(this).closest('.wrapper_block').find('.address_input').val('ул. Вишнёвая, 11');
        }
    });

    $(document).on('change', '.fromtype_select', function(){
        let val = this.selectedOptions[0].value,
            fromTo = $(this).data('fromto'),
            text = this.selectedOptions[0].text;

        if(val !== ''){
            $(this).closest('.clientrequest-'+fromTo+'-form-wrapper').find('.deldata[data-type='+val+']')
                .removeClass('d-none').siblings().addClass('d-none').find('select, input').val('');
        }else{
            $(this).closest('.clientrequest-'+fromTo+'-form-wrapper').find('.deldata').addClass('d-none').find('select, input').val('');
        }

        // if(text === 'Склад ФТЛ'){
        //     $(this).closest('.clientrequest-'+fromTo+'-form-wrapper').find('.ftl_wh_list').show();
        // }else{
        //     $(this).closest('.clientrequest-'+fromTo+'-form-wrapper').find('.ftl_wh_list').hide().find('select').val('');
        // }

    });

    $(document).on('change', '.unl_on_select', function(){
        let val = this.selectedOptions[0].value,
            fromTo = $(this).data('fromto');
       // console.log(val, fromTo);
        if(val !== ''){
            $(this).closest('.clientrequest-'+fromTo+'-wrapper').find('.unl_data[data-type='+val+']')
                .removeClass('d-none').siblings().addClass('d-none').find('select, input').val('');
        }else{
            $(this).closest('.clientrequest-'+fromTo+'-wrapper').find('.unl_data').addClass('d-none').find('select, input').val('');
        }
       // pasteUnlOnData(val, this, num);
    });

    $(document).on('change', '.client_has_container_checkbox', function(){
        let checked = this.checked,
            fromTo = $(this).data('fromto'),
            container = $(this).closest('.clientrequest-'+fromTo+'-wrapper').find('.client_has_container_block');
        if(checked === true){
            $(container).removeClass('d-none');
        }else{
            $(container).addClass('d-none').find('input, select').val('');
        }
    });

    $(document).on('change', '.client_container_place_select', function(){
        let val = this.selectedOptions[0].value,
            fromTo = $(this).data('fromto');
        if(val !== ''){
            $(this).closest('.clientrequest-'+fromTo+'-wrapper').find('.contplace[data-type='+val+']')
                .removeClass('d-none').siblings().addClass('d-none').find('select, input').val('');
        }else{
            $(this).closest('.clientrequest-'+fromTo+'-wrapper').find('.contplace').addClass('d-none').find('select, input').val('');
        }
       // pasteContainerPlaceData(val, this, num);
    });



    $(document).on("click", ".untie-clrqstfrom_form-js", function(e){
        e.preventDefault();
        checkAb();
        $(this).closest('.clientrequest-from-form-wrapper').remove();
    });

    $(document).on('change', '.orderstocreate_checkbox', function(){
        orderCheckboxChangedHandler(this);
    });

    function getJobStatusProgress(statusId){
        let requestEnabled = true;
        if(requestEnabled === true){
            var tes = setInterval(() => {
                $.ajax({
                    type: 'get',
                    url: route('clientrequests.tr.getjobstatusprogress', statusId),
                    success: (res) => {
                        let bar = $('.orders_progress_bar .progress-bar');
                        $(bar).css({
                            width: +res+'%'
                        });
                        $(bar).prop('aria-valuenow', +res);
                        if(res === '100'){
                            clearInterval(tes);
                            location.href = $('.back_to_lead_link').prop('href');
                        }
                    },
                    error: () => {
                        console.log('get job status progress ajax request failed');
                    }
                });
            }, 1000);
        }
    }

    $(document).on('click', '.create_orders_from_cl_request', function(e){
        e.preventDefault();
        saveFormDataEnabled = false;
        $('.client_request_status_field').val('3');

        let uri = route('clientrequests.tr.createorders'),
            _this = $(this);
        $(_this).addClass('d-none');

        setTimeout(function(){
            $.ajax({
                dataType:'json',
                async:false,
                type:'post',
                processData: false,
                contentType: false,
                data: new FormData($("#clientrequestsform")[0]),
                url: uri,
                success: function(res){
                    return new Promise((resolve, reject) => {
                        saveFormData();
                        resolve(res);
                    }).then((statusId) => {
                        $('.orders_progress_bar').removeClass('d-none');
                        getJobStatusProgress(statusId);
                    });
                },
                error: function(){
                    $.notify({
                    message: 'Ошибка сохранения'
                },{
                    type: 'danger'
                });
                }
            });
        }, 1000);

    });

    $(document).on('click', '.add_clrqstfrom_contact-js', function (e) {
        e.preventDefault();
        var _this = $(this),
            wrapper = _this.closest('.clrqst-contacts-from-main'),
            i = 0,
            n = 0;

        if(wrapper.find('.clientrequest-from-contact-wrapper').last().data('i') !== undefined){
            i = parseInt(wrapper.find('.clientrequest-from-contact-wrapper').last().data('i')) + 1;
        }
        if($(this).closest('.clientrequest-from-form-wrapper').data('i') !== undefined){
            n = parseInt($(this).closest('.clientrequest-from-form-wrapper').data('i'));
        }

        var tmpl = $.templates("#clRqstContactsFromTemplate");
        var data = {i: i, n: n};
        var html = tmpl.render(data);
        _this.before(html);
        $(this).siblings('.add_clrqstfrom_contact-js').remove();
        updateFunctions();
    });

    $(document).on("click", ".untie-clrqstfrom_contact-js", function(e){
        e.preventDefault();
        $(this).closest('.clientrequest-from-contact-wrapper').remove();
    });


    $(document).on('click', '.add_clrqstto_contact-js', function (e) {
        e.preventDefault();
        var _this = $(this),
            wrapper = _this.closest('.clrqst-contacts-to-main'),
            i = 0,
            n = 0;

        if(wrapper.find('.clientrequest-to-contact-wrapper').last().data('i') !== undefined){
            i = parseInt(wrapper.find('.clientrequest-to-contact-wrapper').last().data('i')) + 1;
        }
        if($(this).closest('.clientrequest-to-form-wrapper').data('i') !== undefined){
            n = parseInt($(this).closest('.clientrequest-to-form-wrapper').data('i'));
        }

        var tmpl = $.templates("#clRqstContactsToTemplate");
        var data = {i: i, n: n};
        var html = tmpl.render(data);
        _this.before(html);
        $(this).siblings('.add_clrqstto_contact-js').remove();
        updateFunctions();
    });

    $(document).on("click", ".untie-clrqstto_contact-js", function(e){
        e.preventDefault();
        $(this).closest('.clientrequest-to-contact-wrapper').remove();
    });

    $(document).on("click", ".add_clrqstfrom_form-js", function(e){
        e.preventDefault();
        var _this = $(this),
            wrapper = _this.closest('.clientrequest-from-wrapper'),
            i = 0;
            if(wrapper.find('.clientrequest-from-form-wrapper').last().data('i') !== undefined){
                i = parseInt(wrapper.find('.clientrequest-from-form-wrapper').last().data('i')) + 1;
            }
        var tmpl = $.templates("#clRqstFromTemplate");
        var data = {i: i};
        var html = tmpl.render(data);
        _this.before(html);
        $(this).siblings('.add_clrqstfrom_form-js').remove();
        updateFunctions();
    });


    $(document).on("click", ".untie-clrqstto_form-js", function(e){
        e.preventDefault();
        $(this).closest('.clientrequest-to-form-wrapper').remove();
    });

    $(document).on("click", ".add_clrqstto_form-js", function(e){
        e.preventDefault();
        var _this = $(this),
            wrapper = _this.closest('.clientrequest-to-wrapper'),
            i = parseInt(wrapper.find('.clientrequest-to-form-wrapper').last().data('i')) + 1;
        var tmpl = $.templates("#clRqstToTemplate");
        var data = {i: i};
        var html = tmpl.render(data);
        _this.before(html);
        updateFunctions();
    });


    $(document).on('change', '.unl_time_is_interval_checkbox', function(){
        let selectedValue = this.checked;
        if(selectedValue === true){
            $(this).closest('.deldata').find('.unloading_time_interval_block').removeClass('d-none');
            $(this).closest('.deldata').find('.unloading_time_block').addClass('d-none').find('input').val('');
        }else{
            $(this).closest('.deldata').find('.unloading_time_block').removeClass('d-none');
            $(this).closest('.deldata').find('.unloading_time_interval_block').addClass('d-none').find('input').val('');
        }
    });
    updateFunctions();



    function updateFunctions(){
        // $(document).on('keyup', '.cargo_amount', function(){
        //     updateCargoAmountSpace(this);
        // });

        // function updateCargoAmountSpace(input){
        //     input.value = numeral(input.value).format('0,0').replace(/,/g, ' ');
        // }

        runCargoAutocomplete();
        $('.phone_input').inputmask('+7(999) 9999999');
        $(document).on('click', '.add_order_form_btn', function(){
            let _this = this;
            setTimeout(function(){
                let orderBlocksLength = $(_this).closest('.form_data').find('.status_field').length;
                $('.nav.nav-pills.nav-stacked li.active a span').text(`(${orderBlocksLength})`);
            }, 1000);
        });

        $(document).on('click', '.drop_order_form_btn', function(){
            let _this = this;
            setTimeout(function(){
                let orderBlocksLength = $(_this).closest('.form_data').find('.status_field').length;
                $('.nav.nav-pills.nav-stacked li.active a span').text(`(${orderBlocksLength})`);
            }, 1000);
        });

    //    $('.client_request_set_order_status').last().addClass('d-none');



        // $(document).on('click', '.client_request_set_order_status', function(e){
        //     e.preventDefault();
        //     let status = this.dataset.status,
        //         statusField = $('.client_request_status_field'),
        //         id = this.dataset.id;
        //     $(statusField).val(status);
        //     $.ajax({
        //         url: route('clientrequests.setstatus'),
        //         type: 'post',
        //         data: {
        //             id: id,
        //             status: status
        //         }
        //     });
        // });

        $(document).on('click', '.set_order_status', function (e) {
            e.preventDefault();
            let status = this.dataset.status,
                statusField = $(this).siblings('.status_field');

            let statusSetted = new Promise(function(resolve, reject){
                $(statusField).val(status);
                resolve(status);
            });
            statusSetted.then(function(status){
                if(status !== '1'){
                    saveFormData(true, true);
                }
            });
        });
    }




    $(document).on('change', '.clrqst_forwarding_enabled_input', function(){
        let checked = this.checked;

        if(checked === true){
            $('.clrqst_forwarding_block').removeClass('d-none');
        }else{
            $('.clrqst_forwarding_block').addClass('d-none');
        }
    });



    $(document).on('change', '.downloading_scheme_enabled_checkbox', function(){
        let isChecked = this.checked,
            formDataBlock = $(this).closest('.tab-pane').find('.downloading_scheme_enabled_block');
        if(isChecked === true){
            $(formDataBlock).removeClass('d-none');
        }else{
            $(formDataBlock).addClass('d-none');
            $(formDataBlock).find('input').val('');
        }
    });
    $(document).on('change', '.cargo_photo_enabled_checkbox', function(){
        let isChecked = this.checked,
            formDataBlock = $(this).closest('.tab-pane').find('.cargo_photo_enabled_block');
        if(isChecked === true){
            $(formDataBlock).removeClass('d-none');
        }else{
            $(formDataBlock).addClass('hidden');
            $(formDataBlock).find('input').val('');
        }
    });
    $(document).on('change', '.forwarding_enabled_input', function(){
        let checked = this.checked;
        if(checked === true){
            $(this).closest('.tab-pane').find('.forwarding_block').removeClass('hidden');
        }else{
            $(this).closest('.tab-pane').find('.forwarding_block').addClass('hidden');
        }
    });

    $('.downloading_scheme_date').datepicker({
        format: "dd.mm.yyyy",
        autoClose: true,
        minDate: new Date(),
        language: 'ru'
    });
    $('.cargo_photo_date').datepicker({
        format: "dd.mm.yyyy",
        autoClose: true,
        minDate: new Date(),
        language: 'ru'
    });

    // $(document).on('change', '.photofix_enabled_checkbox', function(){
    //     let checked = this.checked;
    //     if(checked === true){
    //         $(this).closest('.forwarding_block').find('.photofix_date_block').removeClass('hidden');
    //     }else{
    //         $(this).closest('.forwarding_block').find('.photofix_date_block').addClass('hidden').find('input').val('');
    //     }
    // });

    $('.photofix_enabled').on('change', function(){
        let photofixBlock = $(this).closest('.form_data').find('.photofix_block');
        if(this.checked === true){
            $(photofixBlock).removeClass('hidden');
        }else{
            $(photofixBlock).find('input').val('');
            $(photofixBlock).addClass('hidden');
        }
    });
    $('.save-form-btn').on('click', function (e) {
        e.preventDefault();
        return new Promise((resolve, reject) => {
            saveFormData(true);
            resolve();
        }).then(() => {
            let href = $('.back_to_lead_link').prop('href');
            location.href = href;
        });
    });





    $('.clientid-select').select2();
    //$.notify.defaults({position: 'top right', autoHideDelay: 3000});


    $(window).on('hashchange', function(e){
        saveFormData();
    });

    setInterval(function(){
        if($('.client_request_status_field').val() !== '3' && saveFormDataEnabled === true){
            saveFormData(true);
        }
    }, 10000);

    $(document).on('change', '.clientrequest_forwarding_checkbox', function(){
        let checked = this.checked;
        $('.forwarding_checkbox').prop('checked', checked);
    });

    $(document).on("click", ".untie-product-js", function(e){
        e.preventDefault();
        $(this).closest('.product-form-wrapper').remove();
        saveFormData(true);
        updateFunctions();
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
        saveFormData(true);
        updateFunctions();
    });


    $(document).on("click", ".untie-dt-js", function(e){
        e.preventDefault();
        $(this).closest('.dt-form-wrapper').remove();
        $('form').trigger('change');
    });
    $(document).on("click", ".add_dt_form-js", function(e){
        e.preventDefault();
        var _this = $(this),
            wrapper = _this.closest('.product-dt-wrapper'),
            dti = parseInt(wrapper.find('.dt-form-wrapper').last().data('dti')) + 1,
            i = parseInt($(this).closest('.product-form-wrapper').data('i'));

        var tmpl = $.templates("#dtTemplate");
        var data = {dtid: dti, id: i};
        var html = tmpl.render(data);
        _this.before(html);

        saveFormData(true);
    });

    $(document).on('change', '.download_type_select', function(){
        let downloadTypeValue = this.value;
        if(downloadTypeValue === '2'){
            $(this).closest('.row').find('.pallet-data').removeClass('d-none');
            $(this).closest('.row').find('.naval-data').addClass('d-none');
            $(this).closest('.row').find('.naval-data input').val('');
        }else{
            $(this).closest('.row').find('.naval-data').removeClass('d-none');
            $(this).closest('.row').find('.pallet-data').addClass('d-none');
            $(this).closest('.row').find('.pallet-data input, .pallet-data select').val('');
        }
    });

    $(document).on('change', '.is_need_to_use_form', function(){
        let isChecked = this.checked,
            formDataBlock = $(this).closest('.form_block').find('.form_data');
        if(isChecked === true){
            $(formDataBlock).removeClass('d-none');
            $('.nav.nav-pills.nav-stacked li.active a span').text('(1)');
        }else{
            $(formDataBlock).addClass('d-none');
            $('.nav.nav-pills.nav-stacked li.active a span').text('(0)');
        }
    });

});
