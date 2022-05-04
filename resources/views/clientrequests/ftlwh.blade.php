<input type="hidden" name="{{$modelName}}[client_request_id]" value="{{$clientId}}">
<div class="form-group">
    <h4>Загрузка в</h4>
    <select name="{{$modelName}}[unl_on]" class="form-control unl_on_select" data-fromto="{{$fromto}}">
        <option value=""></option>
        @foreach(\App\Models\Entities\ClientRequestFrom::unloadingTypesList($lead->type) as $key => $type)
            <option {{isset($model['unl_on']) && $model['unl_on'] == $key ? 'selected' : ''}} value="{{$key}}">{{$type}}</option>
        @endforeach
    </select>
</div>

<div class="unl_on_data">
    <div class="{{isset($model['unl_on']) && $model['unl_on'] == \App\Models\Entities\ClientRequestFrom::UNL_ON_CONTAINER ? '' : 'd-none'}} unlcontainer unl_data" data-type="{{ \App\Models\Entities\ClientRequestFrom::UNL_ON_CONTAINER }}">
        @include('clientrequests.fromto.unldata.unlcontainer',[
            'model' => $model,
            'modelName' => $modelName,
            'fromto' => $fromto
        ])
    </div>
    <div class="{{isset($model['unl_on']) && $model['unl_on'] == \App\Models\Entities\ClientRequestFrom::UNL_ON_RAIL_CARR ? '' : 'd-none'}} unlrailcarr unl_data" data-type="{{ \App\Models\Entities\ClientRequestFrom::UNL_ON_RAIL_CARR }}">
        @include('clientrequests.fromto.unldata.unlrailcarr',[
           'model' => $model,
           'modelName' => $modelName,
           'fromto' => $fromto
       ])
    </div>
    <div class="{{isset($model['unl_on']) && $model['unl_on'] == \App\Models\Entities\ClientRequestFrom::UNL_ON_CAR ? '' : 'd-none'}} unlrailcarr unl_data" data-type="{{ \App\Models\Entities\ClientRequestFrom::UNL_ON_CAR }}">
        @include('clientrequests.fromto.unldata.unlcar',[
           'model' => $model,
           'modelName' => $modelName,
           'fromto' => $fromto
       ])
    </div>
</div>
