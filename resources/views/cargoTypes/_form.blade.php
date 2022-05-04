<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Название</label>
            <input required type="text" value="{{$model['name']}}" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">Тип Загрузки</label>
            <select class="form-control download_type_select" name="download_type">
                <option {{ $model['download_type'] == 'pallet' ? 'selected' : '' }} value="pallet">Паллет</option>
                <option {{ $model['download_type'] == 'naval' ? 'selected' : '' }} value="naval">Навал</option>
            </select>
        </div>
        <div class="form-group pallet_group {{ $model['download_type'] == 'naval' ? 'd-none' : '' }}">
            <label class="control-label">Размер Паллет</label>
            <select class="form-control" name="pallet_size">
                <option value=""></option>
                <option {{ $model['pallet_size'] == '1200*80*1600' ? 'selected' : '' }} value="1200*80*1600">1200*80*1600</option>
                <option {{ $model['pallet_size'] == '1200*80*1800' ? 'selected' : '' }} value="1200*80*1800">1200*80*1800</option>
                <option {{ $model['pallet_size'] == '1200*80*20' ? 'selected' : '' }} value="1200*80*20">1200*80*20</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Клиент</label>
            <select class="form-control" name="client_id">
                <option value=""></option>
                @foreach($clients as $client)
                    <option {{ $client->id == $model['client_id'] ? 'selected' : '' }} value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Поставщик</label>
            <input name="provider_name" type="text" class="form-control" value="{{ $model['provider_name'] }}">
        </div>
    </div>
</div>

@section('js')
    <script>
        $(() => {
            $(document).on('change', '.download_type_select', function(){
                let value = this.value;
                if(value === 'naval'){
                    $('.pallet_group').addClass('d-none');
                }else{
                    $('.pallet_group').removeClass('d-none');
                }
            });
        });
    </script>
@stop
