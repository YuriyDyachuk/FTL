<div class="">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="btn btn-success open_cargos_model d-none">Добавить Груз</a>
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Добавить</th>
                        <th>Груз</th>
                        <th>Клиент</th>
                        <th>Статус</th>
                        <th>Масса, кг</th>
                        <th>Объём, м3</th>
                        <th>Тип Загрузки</th>
                        <th>Размер Паллет</th>
                        <th>Кол-во</th>
                        <th>Добавлен в КЗ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($goods))
                        @foreach($goods as $goodsItem)
                            @if($goodsItem->status !== \App\Models\Entities\GettingActCargo::DONE_STATUS && !$goodsItem->goodsLeads()->exists())
                                <tr>
                                    <td>
                                        <label class="kt-checkbox">
                                            <input class="cargos_checkbox" value="{{ $goodsItem->id }}" name="goods[]" type="checkbox">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{{ $goodsItem->client->name }}</td>
                                    <td>{{ $goodsItem->name }}</td>
                                    <td>{{ $goodsItem->statusLabel }}</td>
                                    <td>{{ $goodsItem->weight }}</td>
                                    <td>{{ $goodsItem->volume }}</td>
                                    <td>{{ $goodsItem->downloadTypeLabel }}</td>
                                    <td>{{ $goodsItem->pallet_size }}</td>
                                    <td>{{ $goodsItem->amount }}</td>
                                    <td>
                                        @if($goodsItem->goodsLeads()->exists())
                                            <a target="_blank" href="{{ route('clientrequests.'.$goodsItem->goodsLeads->lead->getShortLabel().'.edit', $goodsItem->goodsLeads->lead->clientRequest->id) }}">{{ $goodsItem->goodsLeads->lead->clientRequest->id }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
