@extends('page')

@section('title', 'FTL: Клиентская Заявка № ' . $client->id)

@section('content_header')
    Клиентская Заявка сделки № {{ $client->lead->id }}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 pl0">
                @include('partials.orderSetStatusFromShowView', ['route' => 'clientrequests.setstatus', 'model' => $client])
                @include('clientrequests.ktkform', ['model' => $client->ftlwhFrom])
            </div>
            <div class="col-sm-12 pl0">
                <div class="col-sm-4 pl0">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>Статус</th>
                            <td class="{{ App\Models\Entities\EntityStatus::getStatusColor($client->status) }}">{{ App\Models\Entities\EntityStatus::getStatusLabels()[$client->status] }}</td>
                        </tr>
                        <tr>
                            <th>Утепление</th>
                            <td>{{ $client->warming ? '+' : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Скан</th>
                            <td>
                                @if(is_file('storage/images/'.$client['power_of_attorney_scan']))
                                    <a class="table_form_link" data-fancybox="gallery" href="{{ Storage::url('/images/'.$client['power_of_attorney_scan']) }}">
                                        <img style="width: 150px;" class="img-responsive" src="/images/document.png" alt="">
                                    </a>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Экспедирование</th>
                            <td>{{ $client->forwarding_enabled ? '+' : '-' }}</td>
                        </tr>
                    </table>
                    @include('clientrequests.products.showTable', ['client' => $client])
                </div>
                <div class="col-sm-4">
                    @if($client->forwardingRelation()->exists())
                        @include('forwarding.show', ['model' => $client->forwardingRelation])
                    @endif
                </div>
            </div>
            @if($client->trFromTo()->exists())
                <div class="col-sm-12 pl0">
                    @include('clientrequests.tr.show', ['model' => $client->trFromTo])
                </div>
            @endif
            <div class="col-sm-6">
                <h2>Заявки</h2>
                @include('clientrequests.orders', ['lead' => $client->lead])
            </div>
            <div class="col-sm-12">
                <br><br>
                <div class="form-group">
                    <a href="{{ route('leads.edit', ['lead' => $client->lead]) }}" class="btn btn-primary">Вернуться в Сделку</a>
                </div>
            </div>
            <div class="col-sm-12 pl0">
                @widget('orderNotes', ['model' => $client])
            </div>
        </div>
    </div>
@stop
