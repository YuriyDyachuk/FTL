<input type="hidden" name="responsible_user_id" value="{{ $userManager->getId() }}">

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Дата</label>
    <div class="col-lg-8">
        <input type="text" name="date" value="{{ $model['date'] ?: date('d.m.Y') }}" class="date_input form-control">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Время</label>
    <div class="col-lg-8">
        <input type="text" name="time" value="{{ $model['time'] ?: date('H:i')}}" class="time_input form-control">
    </div>
</div>


<div class="form-group row">
    <label class="col-lg-4 col-form-label">Клиент</label>
    <div class="col-lg-8">
        <select class="clients_select form-control" name="client_id">
            <option value=""></option>
            @foreach(\App\Models\Helpers\ClientsHelper::getList() as $id => $name)
                <option {{ $id == $model['client_id'] ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-4 col-form-label">Поставщик</label>
    <div class="col-lg-8">
        <input type="text" name="provider_name" value="{{ $model['provider_name'] }}" class="form-control provider_input">
    </div>
</div>

@section('js')
    <script>
        $(() => {
            let productFormWrapper = $('.product-form-wrapper');
            if(productFormWrapper.length > 0){
                for(let form of productFormWrapper){
                    let cargoTypeIdInputValue = +$(form).find('.cargo_type_id_input')[0].value;
                    if(cargoTypeIdInputValue > 0){
                        $(form).find('input, select').each((i, item) => {
                            let fieldName = item.name.split('[').slice(-1)[0].replace(']', '');
                            if(['name', 'download_type', 'pallet_size'].includes(fieldName)){
                                $(item).prop('readonly', true);
                                if(item.localName === 'select'){
                                    $(item).find('option').each((o, option) => {
                                        if(option.selected === false){
                                            $(option).prop('disabled', true);
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            }

            $(document).on('keyup', '.provider_input', function(){
                runCargoAutocomplete();
            });

            $(document).on('change', '.clients_select', function(){
                runCargoAutocomplete();
            });

            function runCargoAutocomplete(){
                $('.cargo_autocomplete').autocomplete({
                    serviceUrl: route('cargotypes.autocompletelist'),
                    type: 'post',
                    dataType: 'json',
                    params: {
                        client: $('.clients_select')[0].selectedOptions[0].value,
                        provider: $('.provider_input').val()
                    },
                    onSelect: function (suggestion) {
                        $('.clients_select').val(suggestion.client);
                        $('.provider_input').val(suggestion.provider).prop('readonly', true);
                        $('.clients_select option').each((i, item) => {
                            if(+item.value !== suggestion.client){
                                $(item).addClass('d-none');
                            }else{
                                $(item).removeClass('d-none');
                            }
                        });
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
            runCargoAutocomplete();

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
                        $(formWrapper).find('input, select').each((i, item) => {
                            let fieldName = item.name.split('[').slice(-1)[0].replace(']', '');
                            for(let field in res){
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
                if(value === 'naval'){
                    $(this).closest('.product-dt-wrapper').find('.pallet_group').addClass('d-none');
                }else{
                    $(this).closest('.product-dt-wrapper').find('.pallet_group').removeClass('d-none');
                }
            });

            // $(document).on('keyup', '.cargo_amount', function(){
            //     updateCargoAmountSpace(this);
            // });
            //
            // function updateCargoAmountSpace(input){
            //     input.value = numeral(input.value).format('0,0').replace(/,/g, ' ');
            // }

            $(document).on("click", ".untie-product-js", function(e){
                e.preventDefault();
                $(this).closest('.product-form-wrapper').remove();
            });

            $(document).on("click", ".add_product_form-js", function(e){
                e.preventDefault();
                var _this = $(this),
                    wrapper = _this.closest('.product-wrapper'),
                    i = parseInt(wrapper.find('.product-form-wrapper').last().data('i')) + 1;

                var tmpl = $.templates("#cargoTemplate");
                var data = {id: i};
                var html = tmpl.render(data);
                _this.before(html);
                runCargoAutocomplete();
            });
        });
    </script>
@stop
