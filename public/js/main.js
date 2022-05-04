$(function(){
    $('.phone_input').inputmask('+7(999) 9999999');
    $.notifyDefaults({delay: 3000});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        }
    });

    $(document).on('change', '.interval_toggle', function () {
        let selectedValue = this.checked,
            intervalRow = $(this).closest('.interval_row');
        if(selectedValue === true){
            $(intervalRow).find('.interval_enabled').removeClass('d-none');
            $(intervalRow).find('.interval_disabled').addClass('d-none');
        }else{
            $(intervalRow).find('.interval_disabled').removeClass('d-none');
            $(intervalRow).find('.interval_enabled').addClass('d-none');
        }
    });

    $('.span_hover_info').on('mouseleave', function(){
        $('.hover_info_block').remove();
    });
    $('.span_hover_info').on('mouseover', function(){
        var topPos = this.getBoundingClientRect().top    + $(window)['scrollTop']()+10;
        var leftPos  = this.getBoundingClientRect().left   + $(window)['scrollLeft']()+20;
        let text = this.dataset.label;
        let div = $('<div class="hover_info_block">'+text+'</div>');
        $(div).css({
            top: topPos+'px',
            left: leftPos+'px'
        });
        $('body').append(div);
    });

    updateFunctions();
    $(document).on('click', '.add_order_form_btn', function(){
        updateFunctions();
    });
    $(document).on('click', '.drop_order_form_btn', function(){
        updateFunctions();
    });
    function updateFunctions(){
        $('form').prop('autocomplete', 'off');
      //  $('form input').prop('autocomplete', 'new-password');

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

        $('.date_input_all').datepicker({
            format: "dd.mm.yyyy",
            autoClose: true,
            language: 'ru'
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
        let firstOrderFormTitle = $('.firstOrderFormTitle');
        if(firstOrderFormTitle.length > 0){
            for(let i = 1; i < firstOrderFormTitle.length; i++){
                $(firstOrderFormTitle[i]).remove();
            }
        }
    }
});
