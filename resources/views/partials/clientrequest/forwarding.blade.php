<div class="forwarding_block">

{{--    <h3>{{$model == 'clientrequest' ? 'Доп. Услуги' : 'Заявка на экспедирование'}} </h3>--}}
    <h4>Дополнительные услуги</h4>
    <div class="under_line"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Утепление</label>
                    <div class="col-lg-3">
                        <select class="form-control" name="{{$model}}[forwarding][warming]">
                            <option value=""></option>
                            <option {{ $forwarding['warming'] == '1 слой' ? 'selected' : '' }} value="1 слой">1 слой</option>
                            <option {{ $forwarding['warming'] == '2 слоя' ? 'selected' : '' }} value="2 слоя">2 слоя</option>
                            <option {{ $forwarding['warming'] == '3 слоя' ? 'selected' : '' }} value="3 слоя">3 слоя</option>
                            <option {{ $forwarding['warming'] == '4 слоя' ? 'selected' : '' }} value="4 слоя">4 слоя</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="{{$model}}[forwarding][id]" value="{{ $forwarding['id'] }}">

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Полиэтиленовая плёнка 1-2 слоя</label>
                    <div class="col-lg-3">
                        <select name="{{$model}}[forwarding][plastic_film]" class="form-control">
                            <option value=""></option>
                            <option {{ $forwarding['plastic_film'] == '1 слой' ? 'selected' : '' }} value="1 слой">1 слой</option>
                            <option {{ $forwarding['plastic_film'] == '2 слоя' ? 'selected' : '' }} value="2 слоя">2 слоя</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Пенопласт 1200*2400*40 кол-во листов</label>
                    <div class="col-lg-4 pr-0">
                        <input {{ $forwarding['styrofoam_fact'] ? 'readonly' : '' }} min="0" type="text" name="{{$model}}[forwarding][styrofoam]" class="form-control" value="{{$forwarding['styrofoam']}}">
                    </div>
                    <div class="col-lg-4 pl-2 pt-2">
                        <input class="forwarding_fact_checkbox" type="checkbox" name="{{$model}}[forwarding][styrofoam_fact]" {{ $forwarding['styrofoam_fact'] ? 'checked' : '' }}> по факту
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Оргалит 1200*2400 кол-во листов</label>
                    <div class="col-lg-4 pr-0">
                        <input {{ $forwarding['hardboard_fact'] ? 'readonly' : '' }} min="0" type="text" name="{{$model}}[forwarding][hardboard]" class="form-control" value="{{$forwarding['hardboard']}}">
                    </div>
                    <div class="col-lg-4 pl-2 pt-2">
                        <input class="forwarding_fact_checkbox" type="checkbox" name="{{$model}}[forwarding][hardboard_fact]" {{ $forwarding['hardboard_fact'] ? 'checked' : '' }}> по факту
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">ОSB 2500*1250*9 кол-во листов</label>
                    <div class="col-lg-4 pr-0">
                        <input {{ $forwarding['forwarding_fact'] ? 'readonly' : '' }} min="0" type="text" name="{{$model}}[forwarding][osb]" class="form-control" value="{{$forwarding['osb']}}">
                    </div>
                    <div class="col-lg-4 pl-2 pt-2">
                        <input class="forwarding_fact_checkbox" type="checkbox" name="{{$model}}[forwarding][forwarding_fact]" {{ $forwarding['forwarding_fact'] ? 'checked' : '' }}> по факту
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Картон 1200*2200+ кол-во листов</label>
                    <div class="col-lg-4 pr-0">
                        <input {{ $forwarding['cardboard_fact'] ? 'readonly' : '' }} min="0" type="text" name="{{$model}}[forwarding][cardboard]" class="form-control" value="{{$forwarding['cardboard']}}">
                    </div>
                    <div class="col-lg-4 pl-2 pt-2">
                        <input class="forwarding_fact_checkbox" type="checkbox" name="{{$model}}[forwarding][cardboard_fact]" {{ $forwarding['cardboard_fact'] ? 'checked' : '' }}> по факту
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Стрейч плёнка</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][streych_film]"  type="checkbox" {{ $forwarding['streych_film'] ? 'checked' : '' }}></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Обрешётка</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][crate]"  type="checkbox" {{ $forwarding['crate'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Поддон EUR</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][evr_pallet]"  type="checkbox" {{ $forwarding['evr_pallet'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Пересчёт мест</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][places_recalc]"  type="checkbox" {{ $forwarding['places_recalc'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Пересчёт внутри тарных вложений</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][inside_recalc]"  type="checkbox" {{ $forwarding['inside_recalc'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Стикировка</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][stickering]"  type="checkbox" {{ $forwarding['stickering'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Пломбирование места</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][place_filling]"  type="checkbox" {{ $forwarding['place_filling'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Формирование паллет</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][pallet_formation]"  type="checkbox" {{ $forwarding['pallet_formation'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Формирование ассортимента по параметрам</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][parameters_formation]"  type="checkbox" {{ $forwarding['parameters_formation'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Фиксация вязальной проволокой</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][knitting_wire_fixation]"  type="checkbox" {{ $forwarding['knitting_wire_fixation'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Пломбирование фургона</label></div>
                    <div class="col-lg-5"><input name="{{$model}}[forwarding][van_filling]"  type="checkbox" {{ $forwarding['van_filling'] ? 'checked' : '' }}></div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-6"><label class="col-form-label">Фото фискация</label></div>
                    <div class="col-lg-5"><input class="photofix_enabled_checkbox" name="{{$model}}[forwarding][photofix_enabled]"  type="checkbox" {{ $forwarding['photofix_enabled'] ? 'checked' : '' }}></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Другое</label>
                    <div class="col-lg-8">
                        <textarea class="form-control" name="{{$model}}[forwarding][more]" cols="30" rows="10">{{$forwarding['more']}}</textarea>
                    </div>
                </div>
            </div>
        </div>

</div>

@if(isset($noEdit))
    @section('js')
        <script>
            $(() => {
                $('.forwarding_block').find('textarea, select, input').prop('disabled', true);
            });
        </script>
    @stop
@else
    @section('js')
        <script>
            $(() => {
                $(document).on('change', '.forwarding_fact_checkbox',  function(){
                    let checked = this.checked;
                    $(this).closest('.form-group.row').find('input.form-control').prop('readonly', checked);
                });
            });
        </script>
    @stop
@endif

<style>
    .forwarding_block input[type="checkbox"]{
        margin-top: 3px;
    }

    .forwarding_block label{
        padding-top: 0;
        padding-bottom: 0;
        font-size: 11px;
    }
    .forwarding_block .form-group.row{
        margin-bottom: 3px !important;
    }
</style>
