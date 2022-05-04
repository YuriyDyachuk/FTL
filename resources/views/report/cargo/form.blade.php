<h3>Отчет. Груз</h3>

<form action="{{route('warehousecargo.updatestatus')}}" method="post" class="cargo_report_form" style="margin-top: 50px">
    {{method_field('put')}}
    @csrf
    <input type="hidden" name="status" value="{{ \App\Models\Entities\GettingActCargo::IN_THE_WAREHOUSE_STATUS }}">
    <input type="hidden" name="cargo_id" value="{{ $model->id }}">
    <div style="position: relative;" class="product-form-wrapper">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($warehouseCargos))
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Выбрать</th>
                            <th>Клиент</th>
                            <th>Поставщик</th>
                            <th>Груз</th>
                            <th>Статус</th>
                            <th>Масса, кг</th>
                            <th>Объём, м3</th>
                            <th>Тип Загрузки</th>
                            <th>Размер Паллет</th>
                            <th>Кол-во</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($warehouseCargos as $cargo)
                                <tr>
                                    <td>
                                        @if($cargo->status !== \App\Models\Entities\GettingActCargo::IN_THE_WAREHOUSE_STATUS && $model->status !== \App\Models\Entities\EntityStatus::DONE_STATUS)
                                            <label class="kt-checkbox">
                                                <input class="cargos_checkbox" value="{{ $cargo->id }}" name="id[]" type="checkbox">
                                                <span></span>
                                            </label>
                                        @endif
                                    </td>
                                    <td>{{ optional($cargo->client)->name }}</td>
                                    <td>{{ $cargo->provider_name }}</td>
                                    <td>{{ $cargo->name }}</td>
                                    <td>{{ $cargo->getStatusLabel() }}</td>
                                    <td>{{ $cargo->weight }}</td>
                                    <td>{{ $cargo->volume }}</td>
                                    <td>{{ $cargo->download_type == 'pallet' ? 'Паллет' : 'Навал' }}</td>
                                    <td>{{ $cargo->pallet_size }}</td>
                                    <td>{{ $cargo->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h3>Груз не выбран в Склад заявке или уже на складе.</h3>
                @endif
            </div>
        </div>
    </div>
    @if($canEdit && $model->status !== \App\Models\Entities\EntityStatus::DONE_STATUS)
        <button type="submit" class="btn btn-success">Отправить</button>
    @endif
</form>
