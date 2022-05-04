<div class="row">
    <div class="col-4">
        <form id="ktkform">
            @csrf
            {{ method_field('put') }}
            <input type="hidden" value="{{$model['client_request_id']}}" name="ftlwhFrom[client_request_id]">
            <div class="form-group">
                <label class="control-label">КТК префикс</label>
                <input value="{{$model['unl_cont_ktk_prefix']}}" type="text" class="form-control" name="ftlwhFrom[unl_cont_ktk_prefix]">
            </div>

            <div class="form-group">
                <label class="control-label">КТК номер</label>
                <input value="{{$model['unl_cont_ktk_number']}}" type="text" class="form-control" name="ftlwhFrom[unl_cont_ktk_number]">
            </div>

            <div class="form-group">
                <a href="#" class="btn btn-success save_ktk_form">Сохранить</a>
            </div>
        </form>

        @section('js')
            <script>
                $(()=> {
                    $(document).on('click', '.save_ktk_form', function (e) {
                        e.preventDefault();
                        let uri = route('clientrequests.validateandsavektk');
                        $.ajax({
                            dataType:'json',
                            async:false,
                            type:'post',
                            processData: false,
                            contentType: false,
                            data: new FormData($("#ktkform")[0]),
                            url: uri,
                            success: function(res){
                                if(res === 1){
                                    $.notify({
                            message: 'Сохранено'
                        },{
                            type: 'success'
                        });
                                }else{
                                    Object.values(res).forEach(function(item){
                                        $.notify(item, "error");
                                    });
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
                    });
                });
            </script>
        @stop

    </div>
</div>
