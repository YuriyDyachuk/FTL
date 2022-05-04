<h3>Заявка на экспедирование</h3>
<form action="{{ route('forwarding.create') }}" method="post" id="forwarding-form">
    @csrf
{{--    <input type="hidden" name="model[id]" value="{{ $model->id }}">--}}
{{--    <input type="hidden" name="model[class]" value="{{ get_class($model) }}">--}}
    <input type="hidden" name="forwarding[id]" value="{{ $forwarding['id'] }}">

    <div class="form-group">
        <label class="control-label"><input name="forwarding[plastic_film]"  type="checkbox" {{ $forwarding['plastic_film'] ? 'checked' : '' }}>Полиэтиленовая плёнка</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[styrofoam]"  type="checkbox" {{ $forwarding['styrofoam'] ? 'checked' : '' }}>Пенопласт 1200*2400*40</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[hardboard]"  type="checkbox" {{ $forwarding['hardboard'] ? 'checked' : '' }}>Оргалит 1200*2400</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[osb]"  type="checkbox" {{ $forwarding['osb'] ? 'checked' : '' }}>ОSB 2500*1250*9</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[cardboard]"  type="checkbox" {{ $forwarding['cardboard'] ? 'checked' : '' }}>Картон 1200*2200+</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[streych_film]"  type="checkbox" {{ $forwarding['streych_film'] ? 'checked' : '' }}>Стрейч плёнка</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[crate]"  type="checkbox" {{ $forwarding['crate'] ? 'checked' : '' }}>Обрешётка</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[evr_pallet]"  type="checkbox" {{ $forwarding['evr_pallet'] ? 'checked' : '' }}>Поддон EUR</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[places_recalc]"  type="checkbox" {{ $forwarding['places_recalc'] ? 'checked' : '' }}>Пересчёт количество мест</label>
    </div>

    <div class="form-group">
        <label class="control-label">Задание экспедитору</label>
        <input class="form-control" name="forwarding[forwarder_task]"  type="text" value="{{ $forwarding['forwarder_task'] }}">
    </div>

    <div class="form-group">
        <label class="control-label">Размер палет при прогрузке</label>
        <select name="forwarding[pallet_size]" class="form-control">
            <option value=""></option>
            <option {{ $forwarding['pallet_size'] == '1200*80*1600' ? 'selected' : '' }} value="1200*80*1600">1200*80*1600</option>
            <option {{ $forwarding['pallet_size'] == '1200*80*1800' ? 'selected' : '' }} value="1200*80*1800">1200*80*1800</option>
            <option {{ $forwarding['pallet_size'] == '1200*80*2100' ? 'selected' : '' }} value="1200*80*2100">1200*80*2100</option>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label">Утепление</label>
        <select class="form-control" name="forwarding[warming]">
            <option value=""></option>
            <option {{ $forwarding['warming'] == '1 слой' ? 'selected' : '' }} value="1 слой">1 слой</option>
            <option {{ $forwarding['warming'] == '2 слоя' ? 'selected' : '' }} value="2 слоя">2 слоя</option>
            <option {{ $forwarding['warming'] == '3 слоя' ? 'selected' : '' }} value="3 слоя">3 слоя</option>
            <option {{ $forwarding['warming'] == '4 слоя' ? 'selected' : '' }} value="4 слоя">4 слоя</option>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[naval_downloading]"  type="checkbox" {{ $forwarding['naval_downloading'] ? 'checked' : '' }}>Загрузка навал</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[downloading_on_pallet]"  type="checkbox" {{ $forwarding['downloading_on_pallet'] ? 'checked' : '' }}>Загрузка на паллетах</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[oversize_downloading]"  type="checkbox" {{ $forwarding['oversize_downloading'] ? 'checked' : '' }}>Загрузка негабарит</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[inside_recalc]"  type="checkbox" {{ $forwarding['inside_recalc'] ? 'checked' : '' }}>Пересчёт внутри тарных вложений</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[stickering]"  type="checkbox" {{ $forwarding['stickering'] ? 'checked' : '' }}>Стикировка</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[place_filling]"  type="checkbox" {{ $forwarding['place_filling'] ? 'checked' : '' }}>Пломбирование места</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[van_filling]"  type="checkbox" {{ $forwarding['van_filling'] ? 'checked' : '' }}>Пломбирование фургона</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[pallet_formation]"  type="checkbox" {{ $forwarding['pallet_formation'] ? 'checked' : '' }}>Формирование паллет</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[parameters_formation]"  type="checkbox" {{ $forwarding['parameters_formation'] ? 'checked' : '' }}>Формирование ассортимента по параметрам</label>
    </div>

    <div class="form-group">
        <label class="control-label"><input name="forwarding[knitting_wire_fixation]"  type="checkbox" {{ $forwarding['knitting_wire_fixation'] ? 'checked' : '' }}>Фиксация вязальной проволокой</label>
    </div>

    <div class="form-group">
        <label class="control-label">Консолидация</label>
        <select class="form-control" name="forwarding[consolidation]">
            <option value=""></option>
            <option {{ $forwarding['consolidation'] == '(t= +200C)' ? 'selected' : '' }} value="(t= +200C)">(t= +200C)</option>
            <option {{ $forwarding['consolidation'] == '(t= 0 +50C)' ? 'selected' : '' }} value="(t= 0 +50C)">(t= 0 +50C)</option>
            <option {{ $forwarding['consolidation'] == '(t= -180C)' ? 'selected' : '' }} value="(t= -180C)">(t= -180C)</option>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label"><input class="photofix_enabled_checkbox" name="forwarding[photofix_enabled]"  type="checkbox" {{ $forwarding['photofix_enabled'] ? 'checked' : '' }}>Фото фискация</label>
    </div>

{{--    <div class="photofix_date_block {{ $forwarding['photofix_enabled'] ? '' : 'd-none' }}">--}}
{{--        <div class="form-group">--}}
{{--            <label class="control-label">Дата фотофиксации</label>--}}
{{--            <input class="form-control date_input" name="forwarding[photofix_date]"  type="text" value="{{ $forwarding['photofix_date'] }}">--}}
{{--        </div>--}}
{{--    </div>--}}
</form>
