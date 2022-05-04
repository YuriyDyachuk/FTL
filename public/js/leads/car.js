$(function(){
    var weightSliderArray = [],
        volumeSliderArray = [],
        amountSliderArray = [];

    function enableSlider(){
        if($(".slider-amount").length > 0){
            $(".slider-amount").each((i, item) => {
                $(item).ionRangeSlider({
                    type: "single",
                    min: 1,
                    max: item.value,
                    from: item.value,
                    to: item.value,
                    grid: true,
                    onChange: function (data) {
                        let newVolumeValue = Math.round(item.dataset.volume / 100 * data.from_percent),
                            newWeightValue = Math.round(item.dataset.weight / 100 * data.from_percent);

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
                    max: item.dataset.weight,
                    from: item.dataset.weight,
                    to: item.dataset.weight,
                    grid: true,
                    onChange: function (data) {
                        let newVolumeValue = Math.round(item.dataset.volume / 100 * data.from_percent),
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
                        let newWeightValue = Math.round(item.dataset.weight / 100 * data.from_percent),
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

    $(document).on('click', '.submit_add_cargo_to_container', function(e){
        e.preventDefault();
        let form = $(this).closest('form').serialize();
        $(this).addClass('disabled');
        $.ajax({
            url: route('clientrequests.car.updatecargosfromktkreport'),
            type: 'post',
            data: form,
            success: (res) => {
                getKtkModal(res);
            },
            error: () => {
                console.log('update ktk cargo ajax request failed');
            }
        });
    });

    $(document).on('click', '.open_ktkdownl_report', function(e){
        e.preventDefault();
        let lead = this.dataset.lead;

        getKtkModal(lead);
    });

    function getKtkModal(id){
        $.ajax({
            url: route('ktkreport.getmodalform', id),
            type: 'post',
            success: (res) => {
                $('#ktkdownl_report_modal .modal-body').html(res);
                $('#ktkdownl_report_modal').modal('show');
                updateFunctions();
                enableSlider();
            },
            error: () => {
                console.log('get wh getting report modal form ajax request failed');
            }
        });
    }

    $(document).on('click', '.open_whgetting_report', function(e){
        e.preventDefault();
        let id = this.dataset.id;
        getWhGettingReportToModal(id);
    });

    function getWhGettingReportToModal(id){
        $.ajax({
            url: route('whgettingreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#whgetting_report_modal .modal-body').html(res);
                $('#whgetting_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get wh getting report modal form ajax request failed');
            }
        });
    }

    $(document).on('submit', '.whgetting_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getWhGettingReportToModal(res.id);
            },
            error: () => {
                console.log('save wh getting report form ajax request failed');
            }
        });
    });


    $(document).on('click', '.open_driver_report', function(e){
        e.preventDefault();
        let id = this.dataset.id;
        getDriverReportToModal(id);
    });

    $(document).on('submit', '.driver_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getDriverReportToModal(res.id);
            },
            error: () => {
                console.log('save driver report form ajax request failed');
            }
        });
    });

    function getDriverReportToModal(id){
        $.ajax({
            url: route('driverreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#driver_report_modal .modal-body').html(res);
                $('#driver_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get driver report modal form ajax request failed');
            }
        });
    }

    $(document).on('click', '.open_cargo_report', function(e){
        e.preventDefault();
        let id = this.dataset.id;
        getCargoReportToModal(id);
    });

    function getCargoReportToModal(id){
        $.ajax({
            url: route('cargoreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#cargo_report_modal .modal-body').html(res);
                $('#cargo_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get cargo report modal form ajax request failed');
            }
        });
    }

    $(document).on('submit', '.cargo_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getCargoReportToModal(res.id);
            },
            error: () => {
                console.log('save cargo report form ajax request failed');
            }
        });
    });

    $(document).on('click', '.open_heavyrent_report', function(e){
        e.preventDefault();
        let id = this.dataset.id;
        getHeavyRentReportToModal(id);
    });

    function getHeavyRentReportToModal(id){
        $.ajax({
            url: route('heavyrentreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#heavyrent_report_modal .modal-body').html(res);
                $('#heavyrent_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get heavy rent report modal form ajax request failed');
            }
        });
    }

    $(document).on('submit', '.heavyrent_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getHeavyRentReportToModal(res.id);
            },
            error: () => {
                console.log('save heavy rent report form ajax request failed');
            }
        });
    });

    $(document).on('click', '.open_routetrack_report', function (e){
        e.preventDefault();
        let id = this.dataset.id;
        getRouteTrackReportToModal(id);
    });

    $(document).on('submit', '.routetrack_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getRouteTrackReportToModal(res.id);
            },
            error: () => {
                console.log('save route track report form ajax request failed');
            }
        });
    });

    function getRouteTrackReportToModal(id){
        $.ajax({
            url: route('routetrackreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#routetrack_report_modal .modal-body').html(res);
                $('#routetrack_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get route track report modal form ajax request failed');
            }
        });
    }

    $(document).on('click', '.open_waybill_report', function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        getWaybillReportToModal(id);
    });

    function getWaybillReportToModal(id){
        $.ajax({
            url: route('waybillreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#waybill_report_modal .modal-body').html(res);
                $('#waybill_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get waybill report modal form ajax request failed');
            }
        });
    }

    $(document).on('submit', '.waybill_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getWaybillReportToModal(res.id);
            },
            error: () => {
                console.log('save waybill report form ajax request failed');
            }
        });
    });

    $(document).on('click', '.open_carpoint_report', function(e){
        e.preventDefault();
        let id = this.dataset.id;
        getCarPointReportToModal(id);
    });

    $(document).on('submit', '.carpoint_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getCarPointReportToModal(res.id);
            },
            error: () => {
                console.log('save car point report form ajax request failed');
            }
        });
    });

    function getCarPointReportToModal(id) {
        $.ajax({
            url: route('carpointreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#carpoint_report_modal .modal-body').html(res);
                $('#carpoint_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get car point report modal form ajax request failed');
            }
        });
    }

    $(document).on('click', '.open_forwarding_report', function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        getForwardingReportToModal(id);
    });

    $(document).on('click', '.open_car_report', function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        getCarReportToModal(id);
    });

    function getCarReportToModal(id){
        $.ajax({
            url: route('carreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#car_report_modal .modal-body').html(res);
                $('#car_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get train report modal form ajax request failed');
            }
        });
    }

    $(document).on('submit', '.car_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getCarReportToModal(res.id);
            },
            error: () => {
                console.log('save car report form ajax request failed');
            }
        });
    });

    $(document).on('change', '.toggle_checkbox input', function(){
        $(this).closest('.toggle_main_block').find('.toggle_block').toggleClass('d-none');
    });

    function getForwardingReportToModal(id) {
        $.ajax({
            url: route('forwardingreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#forwarding_report_modal .modal-body').html(res);
                $('#forwarding_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get forwarding report modal form ajax request failed');
            }
        });
    }

    $(document).on('submit', '.forwarding_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getForwardingReportToModal(res.id);
            },
            error: () => {
                console.log('save forwarding report form ajax request failed');
            }
        });
    });

    function updateFunctions(){
        $('.phone_input').inputmask('+7(999) 9999999');
        $('.jtoggler').jtoggler();
        $('.date_input').datepicker({
            format: "dd.mm.yyyy",
            autoClose: true,
            minDate: new Date(),
            language: 'ru',
            todayHighlight: true,
            weekStart: 1,
            daysOfWeekHighlighted: '[6, 0]'
        });
        $('.time_input').timepicker({
            showMeridian: false,
            defaultTime: false,
            timeFormat: 'HH:mm',
            interval: 60,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    }

    $(document).on('submit', '.train_report_form', function (e) {
        e.preventDefault();
        let _this = this,
            url = _this.action,
            type = _this.method,
            formData = new FormData(_this);
        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            async: true,
            processData: false,
            contentType: false,
            success: (res) => {
                setSuccessLink(res.id);
                getTrainReportToModal(res.id);
            },
            error: () => {
                console.log('save train report form ajax request failed');
            }
        });
    });

    function getTrainReportToModal(id){
        $.ajax({
            url: route('trainreport.getmodalform', id),
            type: 'get',
            success: (res) => {
                $('#train_report_modal .modal-body').html(res);
                $('#train_report_modal').modal();
                updateFunctions();
            },
            error: () => {
                console.log('get train report modal form ajax request failed');
            }
        });
    }

    function setSuccessLink(id){
        $('a[data-id="'+id+'"]').removeClass(['bg-warning', 'bg-danger']).addClass('bg-success');
    }

    $(document).on('click', '.open_train_report', function (e) {
        e.preventDefault();
        let id = this.dataset.id;
        getTrainReportToModal(id);
    });

    $(document).on('click', '.set_order_status', function (e) {
        e.preventDefault();
        let status = this.dataset.status,
            statusField = $(this).siblings('.status_field');

        let statusSetted = new Promise(function(resolve, reject){
            $(statusField).val(status);
            resolve(status);
        });
        statusSetted.then(function(status){
            saveFormData(true);
        });
    });

    $(document).on('click', '.hide_calendar_lines', function(e){
        e.preventDefault();
        let calendarItem = $(this).closest('.lead_calendar_item')[0],
            dataFrom = calendarItem.dataset.from,
            dataTo = calendarItem.dataset.to;
        $(this).closest('tr').siblings().toggle();
        if(this.innerText === '-'){
            this.innerText = '+';
        }else{
            this.innerText = '-';
        }
        //    console.log(dataFrom, dataTo);
    });
    $(document).on('change', '.railway_carriage_ktk_type_select', function(){
        let val = this.value;
        if(val === 'КТК'){
            $('.owner_group').show().find('.owner_label').text('КТК');
        }else if(val === 'Вагон'){
            $('.owner_group').show().find('.owner_label').text('Вагона');
        }else{
            $('.owner_group').hide();
        }
    });

    $(document).on('click', '.add_date_photo_link', function(e){
        e.preventDefault();
        $(this).closest('td').find('.add_date_photo_form .add_date_photo_file_input').trigger('click');
    });
    $(document).on('change', '.add_date_photo_form .add_date_photo_file_input', function(){
        $(this).closest('form').submit();
    });

    $('.save-form-btn').on('click', function (e) {
        e.preventDefault();
        saveFormData(true);
    });
    $('.clientids-select').select2();

    //$.notify.defaults({position: 'top right', autoHideDelay: 3000});
    function saveFormData(displayNotify = false){
        if($('#updateleadform').length > 0){
            let form = $('#updateleadform').serialize();
            let uri = route('leads.car.validateandsave');
            $.ajax({
                url: uri,
                // async: async,
                type: 'post',
                data: form,
                success: function(res){
                    if(displayNotify === true){
                        if(JSON.parse(res) === 1){
                            $('.add_cl_request').removeClass('d-none');
                            $.notify({
                                message: 'Сохранено'
                            },{
                                type: 'success'
                            });
                        }else{
                            $('.add_cl_request').addClass('d-none');
                            Object.values(JSON.parse(res)).forEach(function(item){
                                $.notify({
                                    message: item[0]
                                },{
                                    type: 'warning'
                                });;
                            });
                        }
                    }
                },
                error: function(){
                    $.notify({
                        message: 'Ошибка сохранения'
                    },{
                        type: 'danger'
                    });;
                }
            });
        }
    }
    $(window).on('hashchange', function(e){
        saveFormData();
    });

    setInterval(function(){
        saveFormData(true);
    }, 5000);

    $(document).on("click", ".untie-product-js", function(e){
        e.preventDefault();
        $(this).closest('.product-form-wrapper').remove();
        saveFormData(true);
    });
    $(document).on("click", ".add_product_form-js", function(e){
        e.preventDefault();
        var _this = $(this),
            wrapper = _this.closest('.product-wrapper'),
            i = parseInt(wrapper.find('.product-form-wrapper').last().data('i')) + 1;

        var tmpl = $.templates("#productTemplate");
        var data = {id: i};
        var html = tmpl.render(data);
        _this.before(html);
        saveFormData(true);
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
            i = parseInt($(this).closest('.product-form-wrapper').data('i'));

        var tmpl = $.templates("#dtTemplate");
        var data = {id: i};
        var html = tmpl.render(data);
        _this.before(html);
        saveFormData(true);
    });

    // $(document).on('change', '.download_type_select', function(){
    //     let downloadTypeValue = this.value;
    //     if(downloadTypeValue === 'pallet'){
    //         $(this).closest('.row').find('.pallet-data').removeClass('d-none');
    //         $(this).closest('.row').find('.naval-data').addClass('d-none');
    //         $(this).closest('.row').find('.naval-data input').val('');
    //     }else{
    //         $(this).closest('.row').find('.naval-data').removeClass('d-none');
    //         $(this).closest('.row').find('.pallet-data').addClass('d-none');
    //         $(this).closest('.row').find('.pallet-data input, .pallet-data select').val('');
    //     }
    // });

    $(document).on('change', '.is_need_to_use_form', function(){
        let isChecked = this.checked,
            formDataBlock = $(this).closest('.form_block').find('.form_data');
        if(isChecked === true){
            $(formDataBlock).removeClass('d-none');
        }else{
            $(formDataBlock).addClass('d-none');
            //$(formDataBlock).find('input, select').val('');
        }
    });

    $('.loading_date').datepicker({
        format: "dd.mm.yyyy",
        autoClose: true,
        minDate: new Date(),
        language: 'ru'
    });
    $('.loading_time').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        maxTime: '23:59',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    $('.unloading_date').datepicker({
        format: "dd.mm.yyyy",
        autoClose: true,
        minDate: new Date(),
        language: 'ru'
    });
    $('.unloading_time').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        maxTime: '23:59',
        startTime: '00:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});
