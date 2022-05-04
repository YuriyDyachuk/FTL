<div class="clrqst-contacts-{{$fromto}}-main">
{{--    <input type="text" value="clientrequest[{{$fromto}}][contacts][{{$n}}]">--}}
    @if($model->contacts()->exists())
        @foreach($model->contacts as $num => $contact)
            <div style="position:relative;" class="wrapper_block clientrequest-{{$fromto}}-contact-wrapper mb-5 mt-5" data-i="{{$num}}" data-n="{{$n}}">
{{--                <input type="text" name="clientrequest[{{$fromto}}][contacts][{{$n}}][{{$num}}][related_id]" value="{{$model['client_request_id']}}">--}}
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">ФИО</label>
                    <div class="col-lg-8">
                        <input name="clientrequest[{{$fromto}}][contacts][{{$n}}][{{$num}}][fio]" type="text" class="form-control" value="{{$contact['fio']}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Телефон</label>
                    <div class="col-lg-8">
                        <input name="clientrequest[{{$fromto}}][contacts][{{$n}}][{{$num}}][phone]" type="text" class="form-control phone_input" value="{{$contact['phone']}}">
                    </div>
                </div>
                @if($num == 0)
                    <a href="#" class="add_clrqst{{$fromto}}_contact-js btn btn-primary">+</a>
                @else
                    <a href="#" class="untie-clrqst{{$fromto}}_contact-js pull-right btn btn-danger">-</a>
                @endif
            </div>
        @endforeach
    @else
        <div style="position:relative;" class="wrapper_block clientrequest-{{$fromto}}-contact-wrapper mb-5 mt-5" data-i="0" data-n="{{$n}}">
{{--            <input type="text" name="clientrequest[{{$fromto}}][contacts][{{$n}}][0][related_id]" value="{{$model['client_request_id']}}">--}}
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">ФИО</label>
                <div class="col-lg-8">
                    <input name="clientrequest[{{$fromto}}][contacts][{{$n}}][0][fio]" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Телефон</label>
                <div class="col-lg-8">
                    <input name="clientrequest[{{$fromto}}][contacts][{{$n}}][0][phone]" type="text" class="form-control phone_input">
                </div>
            </div>
            <a href="#" class="add_clrqst{{$fromto}}_contact-js btn btn-primary">+</a>
        </div>
    @endif
</div>
