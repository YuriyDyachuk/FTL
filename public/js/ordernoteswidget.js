$(function(){
    setTimeout(() => {
        $('.savenote-form').find('input, textarea').attr('disabled', false);
    }, 1000);

    $(document).on('click', '.save-note-btn', function(e){
        e.preventDefault();
        let responsibleUserSelectOptionValue = $('.order_responsible_user_select')[0].selectedOptions[0].value;
        if(responsibleUserSelectOptionValue.length === 0){
            $.notify({
                message: 'Необходимо назначить ответственного Сотрудника'
            },{
                type: 'warning'
            });
            return false;
        }

        $('.order_notes_preloader').removeClass('d-none');

        setTimeout(() => {
            let desc = this.dataset.desc;
            $('.savenote-form').find('.note_desc_input').val(desc);
            let messagesBlock = $('.notes-block').find('.notes'),
                formBlockInputs = $('.savenote-form').find('textarea, input'),
                serializedForm = $(formBlockInputs).serialize(),
                action = $('.savenote-form').data('action'),
                method = $('.savenote-form').data('method'),
                id = '',
                tablename = '',
                formJson = $(formBlockInputs).serializeArray(),
                textArea = $('.savenote-form').find('.message_textarea')[0];
            for(let i in formJson){
                let item = formJson[i];
                if(item.name === 'id'){
                    id = item.value;
                }
                if(item.name === 'tablename'){
                    tablename = item.value;
                }
            }
            if($(this).hasClass('novalidate')){
                handleNote(action, method, serializedForm, id, tablename, messagesBlock);
            }else{
                // if(textArea.value === ''){
                //     $.notify('Необходимо заполнить примечание', 'error')
                // }else{
                //     handleNote(action, method, serializedForm, id, tablename, messagesBlock);
                // }

                handleNote(action, method, serializedForm, id, tablename, messagesBlock);
            }
        }, 5000);
    });




    async function handleNote(action, method, serializedForm, id, tablename, messagesBlock){
       // console.log(action, method, serializedForm);

        await saveNote(action, method, serializedForm);
        location.reload();



        //await getNotes(id, tablename, messagesBlock);
        //$('.message_textarea').val('');
    }

    async function saveNote(action, method, serializedForm){
        $.ajax({
            url: action,
            type: method,
            data: serializedForm,
            async: false,
            success: function(res){
                console.log({res: res});
            },
            error: function(){
                console.log('saveNote failed');
            }
        });
    }

    async function getNotes(id, tablename, messagesBlock){
        $.ajax({
            url: route('ordernotes.getnotes'),
            type: 'post',
            data: {
                id: id,
                tablename: tablename
            },
            async: false,
            success: function(res){
                //console.log({res: res, messagesBlock: messagesBlock});
                $(messagesBlock).html(res.html);
            },
            error: function(){
                console.log('saveNote failed');
            }
        });
    }
});
