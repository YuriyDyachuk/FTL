$(function(){
    // $(document).on('change', '.photofix_enabled_checkbox', function(){
    //     let checked = this.checked;
    //     if(checked === true){
    //         $(this).closest('form').find('.photofix_date_block').removeClass('d-none');
    //     }else{
    //         $(this).closest('form').find('.photofix_date_block').addClass('d-none').find('input').val('');
    //     }
    // });



    // setInterval(function(){
    //     saveForwarding();
    // }, 3000);
    // function saveForwarding(){
    //     if(!$('.forwarding_block').hasClass('d-none')){
    //         let form = $('#forwarding-form').serialize();
    //         let uri = route('forwarding.create');
    //         $.ajax({
    //             url: uri,
    //             // async: async,
    //             type: 'post',
    //             data: form,
    //             success: function(res){
    //                 if(res !== '1'){
    //                     $.notify("Заявка на экспедирование не сохранена", "error");
    //                 }
    //             },
    //             error: function(){
    //                 $.notify({
                    message: 'Ошибка сохранения'
                },{
                    type: 'danger'
                });
    //             }
    //         });
    //     }
    // }
    $(document).on('change', '.forwarding_enabled_input', function(){
        let checked = this.checked;
        for(let item of $('.forwarding_enabled_input')){
            item.checked = checked;
        }
        if(checked === true){
            $('.forwarding_block').removeClass('d-none');
        }else{
            $('.forwarding_block').addClass('d-none');
        }
    });
});
