<div class="mt-5">
    <div class="row">
        <div class="col-3">
                <input type="hidden" name="trFromTo[clientrequest_id]" value="{{ $client->id }}">
                <h3>Отправление</h3>
                <div class="form-group">
                    <label class="control-label">Дата отправления</label>
                    <input type="text" name="trFromTo[from_date]" value="{{ $model['from_date'] }}" class="date_input form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Город</label>
                    <input type="text" name="trFromTo[from_city]" value="{{ $model['from_city'] }}" class="form-control">
                </div>
                <h3>Контактное лицо</h3>
                <div class="form-group">
                    <label class="control-label">ФИО</label>
                    <input type="text" name="trFromTo[from_contact_name]" value="{{ $model['from_contact_name'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Телефон</label>
                    <input type="text" name="trFromTo[from_contact_phone]" value="{{ $model['from_contact_phone'] }}" class="form-control phone_input">
                </div>

                <h3>Доверенность</h3>

                <div class="form-group">
                    <label class="control-label">№-Релиз</label>
                    <input type="number" name="trFromTo[from_power_of_attorney_number]" value="{{$model['from_power_of_attorney_number']}}" class="form-control">
                    <input type="hidden" name="trFromTo[from_power_of_attorney_scan]" value="{{$model['from_power_of_attorney_scan']}}">
                </div>

                @if(is_file('storage/images/'.$model['from_power_of_attorney_scan']))
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Скан</label>
                                <input class="form-control" type="file" name="trFromTo[from_power_of_attorney_scan_file]">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['from_power_of_attorney_scan']) }}">
                                <img style="width: 150px;" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label class="control-label">Скан</label>
                        <input class="form-control" type="file" name="trFromTo[from_power_of_attorney_scan_file]">
                    </div>
                @endif
            </div>
        <div class="col-3">
                <h3>Получение</h3>
                <div class="form-group">
                    <label class="control-label">Город</label>
                    <input type="text" name="trFromTo[to_city]" value="{{ $model['to_city'] }}" class="form-control">
                </div>
                <h3>Контактное лицо</h3>
                <div class="form-group">
                    <label class="control-label">ФИО</label>
                    <input type="text" name="trFromTo[to_contact_name]" value="{{ $model['to_contact_name'] }}" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">Телефон</label>
                    <input type="text" name="trFromTo[to_contact_phone]" value="{{ $model['to_contact_phone'] }}" class="form-control phone_input">
                </div>

                <h3>Доверенность</h3>

                <div class="form-group">
                    <label class="control-label">№-Релиз</label>
                    <input type="number" name="trFromTo[to_power_of_attorney_number]" value="{{$model['to_power_of_attorney_number']}}" class="form-control">
                    <input type="hidden" name="trFromTo[to_power_of_attorney_scan]" value="{{$model['to_power_of_attorney_scan']}}">
                </div>

                @if(is_file('storage/images/'.$model['to_power_of_attorney_scan']))
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Скан</label>
                                <input class="form-control" type="file" name="trFromTo[to_power_of_attorney_scan_file]">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <a class="table_form_link" data-fancybox="gallery"
                               href="{{ Storage::url('/images/'.$model['to_power_of_attorney_scan']) }}">
                                <img style="width: 150px;" class="img-responsive" src="/images/document.png" alt="">
                            </a>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label class="control-label">Скан</label>
                        <input class="form-control" type="file" name="trFromTo[to_power_of_attorney_scan_file]">
                    </div>
                @endif
            </div>
    </div>
</div>
