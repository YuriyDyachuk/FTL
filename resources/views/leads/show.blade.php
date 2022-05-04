{{--@extends('page')--}}

{{--@section('title', 'FTL: Сделка № ' . $lead->id)--}}

{{--@section('content_header')--}}
{{--    Сделка клиента {{ $lead->client }}--}}
{{--@stop--}}

{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-12">--}}
{{--            <form action="{{ route('leads.destroy', ['lead' => $lead]) }}" method="post">--}}
{{--                @csrf--}}
{{--                {{ method_field('delete') }}--}}
{{--                <button onclick="return confirm('Вы подтверждаете удаление?');" type="submit" class="btn btn-danger">Удалить</button>--}}
{{--            </form>--}}
{{--            <div class="table">--}}
{{--                <table class="table table-hover table-stripped">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Клиент</th>--}}
{{--                        <th>КТК префикс</th>--}}
{{--                        <th>КТК номер</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>{{ $lead->client }}</td>--}}
{{--                        <td>{{ $lead->ktk_prefix }}</td>--}}
{{--                        <td>{{ $lead->ktk_num }}</td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--                <div class="table" style="overflow-x: scroll;">--}}
{{--                    <table class="table table-hover table-stripped table-bordered">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>ЖД</th>--}}
{{--                            <th></th>--}}
{{--                            @foreach($period as $dt)--}}
{{--                                <th>{{ $dt->format('d-m-Y') }}</th>--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <th>Создать заявку</th>--}}
{{--                            @foreach($period as $dt)--}}
{{--                                @if($lead->trainLeadOrder && $lead->trainLeadOrder->order_date === $dt->format('d.m.Y'))--}}
{{--                                    <td class="bg-danger"></td>--}}
{{--                                @else--}}
{{--                                    <td></td>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <th>Погрузка</th>--}}
{{--                            @foreach($period as $dt)--}}
{{--                                @if($lead->trainLeadOrder && $lead->trainLeadOrder->loading_date === $dt->format('d.m.Y'))--}}
{{--                                    <td class="bg-danger"></td>--}}
{{--                                @else--}}
{{--                                    <td></td>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <th>Выгрузка</th>--}}
{{--                            @foreach($period as $dt)--}}
{{--                                @if($lead->trainLeadOrder && $lead->trainLeadOrder->unloading_date === $dt->format('d.m.Y'))--}}
{{--                                    <td class="bg-danger"></td>--}}
{{--                                @else--}}
{{--                                    <td></td>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@stop--}}
