$(() => {
    if($('.status_field').val() === '2' && $('.block_form.no_disable_form').length > 0){
        setInterval(() => {
            saveReportForms();
        }, 5000);
    }
    if($('.status_field').val() !== '1'){
        $('input, select, textarea').prop('disabled', true);
        $('.no_disable_form').find('input, select, textarea').prop('disabled', false);
        $('.external_product').remove();
    }else{
        setInterval(() => {
            saveMainForm();
        }, 5000);
    }

    function saveReportForms(){
        return new Promise((resolve, reject) => {
            $('.block_form.no_disable_form').each((i, item) => {
                let data = new FormData(item);
                $.ajax({
                    dataType: 'json',
                    async: true,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: data,
                    url: route('order.updateblock'),
                    success: function(res){
                        if(res !== 1){
                            Object.values(res).forEach(function(item){
                                $.notify({
                                    message: item[0]
                                },{
                                    type: 'warning'
                                });
                            });
                        }
                    },
                });
            });
            resolve();
        }).then(() => {
            $.notify({
                message: 'Сохранено'
            },{
                type: 'success'
            });
        });
    }

    $(document).on('click', '.chat-panel-header', function () {
        $('.chat-panel-body').toggleClass('d-none');
        var objDiv = $('.chat-history');
        objDiv.scrollTop(objDiv.prop("scrollHeight"));
    });

    function saveBlockForms(){
        return new Promise((resolve, reject) => {
            $('.block_form').each((i, item) => {
                let data = new FormData(item);
                $.ajax({
                    dataType: 'json',
                    async: true,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: data,
                    url: route('order.updateblock'),
                    success: function(res){
                        if(res !== 1){
                            //$('.order_notes_buttons_block').addClass('d-none');
                            Object.values(res).forEach(function(item){
                                $.notify({
                                    message: item[0]
                                },{
                                    type: 'warning'
                                });
                            });
                        }
                    },
                });
            });
            resolve();
        }).then(() => {
            $.notify({
                message: 'Сохранено'
            },{
                type: 'success'
            });
        });

    }

    function validateGoods(){
        if($('.status_field').val() !== '1'){
            return false;
        }

        if($('.goods_form').length === 0){
            saveBlockForms();
            return false;
        }

        let mainForm = $('.goods_form')[0],
            uri = mainForm.action,
            type = mainForm.method,
            data = new FormData(mainForm);

        $.ajax({
            dataType: 'json',
            async: true,
            type: type,
            processData: false,
            contentType: false,
            data: data,
            url: uri,
            success: function(res){
                if(res === 1){
                    saveBlockForms();
                }else{
                    Object.values(res).forEach(function(item){
                        $.notify({
                            message: item[0]
                        },{
                            type: 'warning'
                        });
                    });
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
    }

    function saveMainForm(){
        if($('.status_field').val() !== '1'){
            return false;
        }

        let mainForm = $('.main_block_form')[0],
            uri = mainForm.action,
            type = mainForm.method,
            data = new FormData(mainForm);

        $.ajax({
            dataType: 'json',
            async: true,
            type: type,
            processData: false,
            contentType: false,
            data: data,
            url: uri,
            success: function(res){
                if(res === 1){
                    validateGoods();
                    $('.order_notes_buttons_block').removeClass('d-none');
                }else{
                    $('.order_notes_buttons_block').addClass('d-none');
                    Object.values(res).forEach(function(item){
                        $.notify({
                            message: item[0]
                        },{
                            type: 'warning'
                        });
                    });
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
    }
});
