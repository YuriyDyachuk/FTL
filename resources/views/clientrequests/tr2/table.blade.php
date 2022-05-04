<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Склад Клиента</th>
                <th>Склад ФТЛ</th>
                <th>ЖД Станция</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Склад Поставщика</th>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::PRWH_PRWH }}"></td>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::PRWH_FTL }}"></td>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::PRWH_TR }}"></td>
            </tr>
            <tr>
                <th>Склад ФТЛ</th>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::FTL_PRWH }}"></td>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::FTL_FTL }}"></td>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::FTL_TR }}"></td>
            </tr>
            <tr>
                <th>ЖД Станция</th>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::TR_PRWH }}"></td>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::TR_FTL }}"></td>
                <td><input type="radio" class="order_radio_btn" name="clientrequest[orders_type]" value="{{ App\Models\Entities\ClientRequests::TR_TR }}"></td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" name="clientrequest[orders_type_enabled]" value="1">

    </div>

</div>

{{--<div class="row">--}}
{{--    <div class="col">--}}
{{--        <img width="100" src="{{ Storage::url('/images/preloader.gif') }}" alt="" class="preload_orders d-none">--}}
{{--        <a href="#" class="btn btn-success create_orders_from_cl_request d-none">Сформировать заявки</a>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="row">
    <div class="col">
        <a href="#" class="btn btn-primary open_orders_modal d-none">Выбрать заявки в Отделы</a>
    </div>
</div>



@push('head')
    <script>
        $(function(){
            // $(document).on('change', '.orderstocreate_checkbox', function(){
            //     let checked = this.checked;
            //     if(checked === false){
            //         $(this).closest('td').find('.orderstocreate_count').val('0');
            //     }else{
            //         $(this).closest('td').find('.orderstocreate_count').val('1');
            //     }
            // });
            // $(document).on('click', '.open_orders_modal', function (e) {
            //     e.preventDefault();
            //     let url = route('clientrequests.pickorders'),
            //         value = {type: this.dataset.value};
            //     $.ajax({
            //         type: 'post',
            //         url: url,
            //         data: value,
            //         success: (res) => {
            //             $('#clOrdersModal .modal-body').html(res);
            //             $('.jtoggler').jtoggler();
            //         },
            //         error: () => console.log('clientrequests.pickorders ajax request failed')
            //     });
            //     $('#clOrdersModal').modal('show');
            // });

            // $(document).on('change', '.order_radio_btn', function(){
            //     $('.client_request_set_order_status').last().removeClass('d-none').attr('data-value', this.value);
            //    // $('.open_orders_modal').removeClass('d-none').attr('data-value', this.value);
            // });

            // $(document).on('click', '.create_orders_from_cl_request', function(e){
            //     e.preventDefault();
            //
            //     let uri = route('clientrequests.createorders'),
            //         _this = $(this);
            //     $('.preload_orders').removeClass('d-none');
            //     $(_this).addClass('d-none');
            //
            //     setTimeout(function(){
            //         $.ajax({
            //             dataType:'json',
            //             async:false,
            //             type:'post',
            //             processData: false,
            //             contentType: false,
            //             data: new FormData($("#clientrequestsform")[0]),
            //             url: uri,
            //             success: function(res){
            //                 $(_this).removeClass('d-none');
            //                 $('.preload_orders').addClass('d-none');
            //                 saveFormData(true, true);
            //                 //$.notify('Заявки успешно сформированы', 'success');
            //             },
            //             error: function(){
            //                 $.notify({
                    message: 'Ошибка сохранения'
                },{
                    type: 'danger'
                });;
            //             }
            //         });
            //     }, 1000);
            //
            // });
        });
    </script>
@endpush
