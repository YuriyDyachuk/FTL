@include('clientrequests.fromto.templates.from',[ 'model' => new \App\Models\Entities\ClientRequestFrom(), 'fromto' => 'from'])
@include('clientrequests.fromto.templates.to',[ 'model' => new \App\Models\Entities\ClientRequestFrom(), 'fromto' => 'to'])
<input type="hidden" name="lead_id" value="{{ $lead->id }}">


<div class="row mb-5">
    <div class="under_line"></div>
    <div class="col-md-4 mt-5">
        <div class="clientrequest-from-wrapper">
            @include('clientrequests.ftlwh', [
                   'model' => $client->ftlwhFrom,
                   'modelName' => 'ftlwhFrom',
                   'fromto' => 'from',
                   'clientId' => $client->id
               ])
        </div>
        <input type="hidden" value="{{ $client->id }}" name="clientrequest[id]">
        <input class="status_field client_request_status_field" type="hidden" value="{{ $client['status'] === '1' ? \App\Models\Entities\EntityStatus::IN_PROCESS_STATUS : $client['status'] }}" name="clientrequest[status]">

    </div>
</div>

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="delivery_ab_block">
            <div class="row">
                <div class="clientrequest-from-wrapper col-md-6 from">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 align="center">Пункт Отправления "A"</h4>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Дата отправления</label>
                                <div class="col-lg-8">
                                    <input value="{{ $client->delivery_date }}" name="clientrequest[delivery_date]" type="text" class="date_input form-control">
                                </div>
                            </div>
                            @if($client->clientRequestFroms()->exists())
                                @foreach($client->clientRequestFroms as $n => $fromModel)
                                    @include('clientrequests.fromto.form', [
                                        'model' => $fromModel,
                                        'fromto' => 'from',
                                        'n' => $n,
                                        'count' => $client->clientRequestFroms()->count(),
                                        'showPlusBtn' => ($n+1) == $client->clientRequestFroms()->count(),
                                    ])
                                @endforeach
                            @else
                                @include('clientrequests.fromto.form', [
                                    'model' => new \App\Models\Entities\ClientRequestFrom(),
                                    'fromto' => 'from',
                                    'n' => 0,
                                    'count' => 0,
                                    'showPlusBtn' => true
                                ])
                            @endif
                            {{--                    <div class="clearfix"><a href="#" class="add_clrqstfrom_form-js btn btn-primary">+</a></div>--}}
                        </div>
                    </div>
                </div>
                <div class="clientrequest-to-wrapper col-md-6 to">
                    <div class="row">
                        <div class="col-md-11">
                            <h4 align="center">Пункт Получения "B"</h4>
                            @if($client->clientRequestTos()->exists())
                                @foreach($client->clientRequestTos as $n => $toModel)
                                    @include('clientrequests.fromto.form', [
                                    'model' => $toModel,
                                    'fromto' => 'to',
                                    'n' => $n,
                                    'count' => $client->clientRequestTos()->count(),
                                    'showPlusBtn' => ($n+1) == $client->clientRequestTos()->count(),
                                ])
                                @endforeach
                            @else
                                @include('clientrequests.fromto.form', [
                                    'model' => new \App\Models\Entities\clientRequestTo(),
                                    'fromto' => 'to',
                                    'n' => 0,
                                    'count' => 0,
                                    'showPlusBtn' => true
                                ])
                            @endif
                            {{--                    <div class="clearfix"><a href="#" class="add_clrqstto_form-js btn btn-primary">+</a></div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12">
        @include('clientrequests.products.form', ['lead' => $lead, 'client' => $client])
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="clrqst_forwarding_block">
            @include('partials.clientrequest.forwarding', [
            'forwarding' => $client && $client->forwardingRelation()->exists() ?
            $client->forwardingRelation : new \App\Models\Entities\Forwarding(),
            'model' => "clientrequest"
            ]
            )
        </div>
    </div>
</div>
