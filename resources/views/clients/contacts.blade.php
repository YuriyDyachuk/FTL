@include('/clients/tmp/contactTemplate')

<div class="contact-wrapper row">
    @if($client->contacts && $client->contacts()->exists())
        @foreach($client->contacts as $n => $contact)
            <div style="position: relative;" class="contact-form-wrapper mt-5 col-md-6" data-i="{{ $n }}">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="contacts[{{ $n }}][photo]" value="{{$contact['photo']}}">
                        @if(is_file('storage/images/'.$contact['photo']))
                            <div class="">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Фото</label>
                                    <div class="col-lg-7">
                                        <div class="custom-file">
                                            <input class="custom-file-input" type="file" name="contacts[{{ $n }}][photo_file]">
                                            <label class="custom-file-label">Фото</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 p-0">
                                        <a class="" data-fancybox="gallery"
                                           href="{{ Storage::url('/images/'.$contact['photo']) }}">
                                            <img style="width: 30px;" class="img-responsive" src="/images/document.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Фото</label>
                                <div class="col-lg-8">
                                    <div class="custom-file">
                                        <input class="custom-file-input" type="file" name="contacts[{{ $n }}][photo_file]">
                                        <label class="custom-file-label">Фото</label>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="form-group row field-contacts-{{ $n }}-name">
                            <label class="col-lg-4 col-form-label" for="contacts-{{ $n }}-name">ФИО</label>
                            <div class="col-lg-8">
                                <input value="{{ $contact->name }}" class="form-control" name="contacts[{{ $n }}][name]" id="contacts-{{ $n }}-name">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row field-contacts-{{ $n }}-position">
                            <label class="col-lg-4 col-form-label" for="contacts-{{ $n }}-position">Должность</label>
                            <div class="col-lg-8">
                                <input value="{{ $contact->position }}" class="form-control" name="contacts[{{ $n }}][position]" id="contacts-{{ $n }}-position">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row field-contacts-{{ $n }}-phone">
                            <label class="col-lg-4 col-form-label" for="contacts-{{ $n }}-phone">Телефон</label>
                            <div class="col-lg-8">
                                <input value="{{ $contact->phone }}" class="phone_input form-control" name="contacts[{{ $n }}][phone]" id="contacts-{{ $n }}-phone">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row field-contacts-{{ $n }}-email">
                            <label class="col-lg-4 col-form-label" for="contacts-{{ $n }}-email">Email</label>
                            <div class="col-lg-8">
                                <input value="{{ $contact->email }}" class="form-control" name="contacts[{{ $n }}][email]" id="contacts-{{ $n }}-email">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($n > 0)
                    <a style="position: absolute;left: 50px;bottom: -30px;" href="#" class="untie-contact-js pull-right btn btn-danger">-</a>
                @endif
            </div>
        @endforeach
    @else
        <div style="position: relative;" class="contact-form-wrapper mt-5 col-md-6" data-i="0">
            <div class="row">
                <input type="hidden" name="contacts[0][photo]">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Фото</label>
                        <div class="col-lg-8">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="contacts[0][photo_file]">
                                <label class="custom-file-label">Фото</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row field-contacts-0-name">
                        <label class="col-lg-4 col-form-label" for="contacts-0-name">ФИО</label>
                        <div class="col-lg-8">
                            <input class="form-control" name="contacts[0][name]" id="contacts-0-name">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group row field-contacts-0-position">
                        <label class="col-lg-4 col-form-label" for="contacts-0-position">Должность</label>
                        <div class="col-lg-8">
                            <input class="form-control" name="contacts[0][position]" id="contacts-0-position">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group row field-contacts-0-phone">
                        <label class="col-lg-4 col-form-label" for="contacts-0-phone">Телефон</label>
                        <div class="col-lg-8">
                            <input class="phone_input form-control" name="contacts[0][phone]" id="contacts-0-phone">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group row field-contacts-0-email">
                        <label class="col-lg-4 col-form-label" for="contacts-0-email">Email</label>
                        <div class="col-lg-8">
                            <input class="form-control" name="contacts[0][email]" id="contacts-0-email">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{--                                <a style="position: absolute;right: -50px;top: 100px;" href="#" class="untie-contact-js pull-right btn btn-danger">-</a>--}}
        </div>
    @endif
    <a href="#" style="position: absolute; bottom: -30px; left: 15px;" class="add_contact_form-js btn btn-primary">+</a>
</div>
