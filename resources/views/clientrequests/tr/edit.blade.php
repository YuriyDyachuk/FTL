@extends('page')

@section('title', 'FTL: Клиентская Заявка № ' . $client->id)

@section('content_header')
    Клиентская Заявка № {{ $client->id }}
@stop
@push('head')
    <script src="{{ asset('js/clientrequests/tr.js') }}"></script>
{{--    <script src="{{asset('js/statusmanager.js')}}"></script>--}}
    <meta name="csrf-token" content="{!! csrf_token() !!}">
@endpush

@section('content')
    @include('errors')
    <div class="container-fluid">
        <div class="w-100">
            @include('partials.clientRequestManageStatuses', ['lead' => $lead, 'model' => $client])
            <h5>Менеджер сделки - {{$lead->responsibleUser->name}}</h5>
            <h3>Сделка</h3>
            <div class="under_line"></div>
            <div class="row mb-4">

                @forelse($lead->clients as $leadClient)
{{--                    {{ dd($leadClient->inn) }}--}}
                    <div class="col-md-6 pl-5">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Клиент</label>
                            <div class="col-lg-6">
                                <input class="form-control client_input" type="text" disabled value="{{ $leadClient->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">ИНН</label>
                            <div class="col-lg-6">
                                <input class="form-control" type="text" disabled value="{{ $leadClient->inn }}">
                            </div>
                        </div>
                    </div>
                @empty
                    <h1>Клиенты не выбраны</h1>
                @endforelse
            </div>
            <form enctype="multipart/form-data" id="clientrequestsform" action="{{route('clientrequests.tr.update', ['client' => $client])}}" method="post">
                @csrf
                {{ method_field('put') }}

                <div class="col-md-12 pl0">
                    @permission('client_request_edit')
                        @include('clientrequests.tr.form', ['lead' => $lead, 'client' => $client])
                    @endpermission
                </div>

                <div class="col-md-12">
                    <h3>Порядок заявок</h3>
                    <div class="under_line"></div>
                    <div class="orders_to_create_block"></div>
                    <img width="100" src="/images/preloader.gif" alt="" class="preload_orders d-none">
                    <div class="orders_progress_bar col-sm-12 d-none">
                        <h3>Формирование заявок...</h3>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                        </div>
                    </div>
                    <button type="button" class="d-none btn btn-primary create_orders_from_cl_request">Сформировать заявки</button>
                </div>

                <div class="col-sm-12 pl0">
                    <br><br>
                    <div class="form-group">
                        <a href="{{ route('leads.tr.edit', ['lead' => $lead]) }}" class="btn btn-primary back_to_lead_link">Вернуться в Сделку</a>
                    </div>
                    @if($userManager->getId() == $lead->responsible_user_id || $userManager->hasRole('admin'))
                        <div class="form-group">
                            <a href="#" class="btn btn-success save-form-btn">Сохранить</a>
                        </div>
                    @endif
                </div>
{{--                @include('clientrequests.ordersModal')--}}
            </form>
            <div class="col-sm-12 pl0">
                @if($userManager->getId() == $lead->responsible_user_id || $userManager->hasRole('admin'))
                    <form action="{{ route('clientrequests.tr.destroy', ['client' => $client]) }}" method="post">
                        @csrf
                        {{ method_field('delete') }}
                        <input type="hidden" name="id" value="{{ $client->id }}">
                        <button onclick="return confirm('Вы подтверждаете удаление?');" type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                @endif
            </div>
        </div>


    </div>

    @include('clientrequests.importcargo.modal')
@stop
