@extends('page')

@push('head')
    <script src="{{asset('js/client.js')}}"></script>
@endpush

@php
    $clientTitle = 'Новый Клиент';
    if(!empty($client->name)){
        $clientTitle = 'FTL: '.$client->name;
    }
@endphp

@section('title', $clientTitle)

{{--@section('content_header'){{ $clientTitle }}@stop--}}

@section('content')
    <div class="kt-portlet__body">
        <div class="col-md-8 offset-md-1">
            <h3><i class="fas fa-location-arrow requisites_btn"></i> Реквизиты</h3>
            <div class="requisites">
                <div class="row">
                    <div class="under_line"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ $client->name }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                        <a href="{{route('clients.edit', ['client' => $client])}}" class="btn btn-warning">Редакт</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <ul style="list-style-type: none" class="no-pl">
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>ИНН</b></div>
                                    <div class="col-md-9">{{$client->inn}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>ОГРН</b></div>
                                    <div class="col-md-9">{{$client->ogrn}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>Юр.Адрес</b></div>
                                    <div class="col-md-9">{{$client->leg_address}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>Почт.Адрес</b></div>
                                    <div class="col-md-9">{{$client->mail_address}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>Факт.Адрес</b></div>
                                    <div class="col-md-9">{{$client->fact_address}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>Подписант</b></div>
                                    <div class="col-md-9">{{$client->signatory}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>ФИО</b></div>
                                    <div class="col-md-9">{{$client->fio}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>Доверенность</b></div>
                                    <div class="col-md-9">{{$client->power_of_attorney}}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul style="list-style-type: none" class="no-pl">
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>КПП</b></div>
                                    <div class="col-md-9">{{$client->kpp}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>ОКПО</b></div>
                                    <div class="col-md-9">{{$client->okpo}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>Банк</b></div>
                                    <div class="col-md-9">{{$client->bank}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>БИК</b></div>
                                    <div class="col-md-9">{{$client->bik}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>К - счет</b></div>
                                    <div class="col-md-9">{{$client->k_account}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-3"><b>Р - счет</b></div>
                                    <div class="col-md-9">{{$client->r_account}}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>




            <h3 class="mt-5"><i class="fas fa-location-arrow contacts_btn"></i> Контактные лица</h3>
            <div class="under_line"></div>
            <div class="contacts">
                <div class="row">
                    @if($client->contacts && $client->contacts()->exists())
                        @foreach($client->contacts as $n => $contact)
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if(is_file('storage/images/'.$contact['photo']))
                                            <img width="100" src="{{ Storage::url('/images/'.$contact['photo']) }}" alt="">
                                        @else
                                            <img src="/assets/media/users/default.jpg" alt="">
                                        @endif

                                    </div>
                                    <div class="col-md-8">
                                        <ul class="no_lst">
                                            <li>{{$contact->name}}</li>
                                            <li>{{$contact->position}}</li>
                                            <li>{{$contact->phone}}</li>
                                            <li>{{$contact->email}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>



            <h3 class="mt-5"><i class="fas fa-location-arrow reglament_btn"></i> Регламент</h3>
            <div class="under_line"></div>
            <div class="reglament pl-4">
                @if(!empty($images))
                    @foreach($images as $label => $image)
                        <div class="row">
                            <p><b>{{ \App\Models\Helpers\ImageTypesHelper::getNameById($label) }}</b></p>
                        </div>
                        <div class="row">
                            @foreach($image as $item)
                                @if(is_file('storage/images/'.$item['file_name']))
                                    <div class="col-md-4">
                                        <a class="table_form_link" data-fancybox="gallery"
                                           href="{{ Storage::url('/images/'.$item['file_name']) }}">
                                                <span>
                                                    <img style="width: 50px;" class="img-responsive" src="/assets/media/files/pdf.svg" alt="">
                                                </span>
                                        </a>
                                        {{$item['name']}}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>


            <h3 class="mt-5"><i class="fas fa-location-arrow fabula_btn"></i> Фабула договора</h3>
            <div class="under_line"></div>
            <div class="fabula">
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                        <a href="{{route('clients.edit', ['client' => $client])}}" class="btn btn-warning">Редакт</a>
                    </div>
                </div>

                @include('clients.regulation', ['client' => $client, 'edit' => false])
            </div>
        </div>
    </div>
@stop
