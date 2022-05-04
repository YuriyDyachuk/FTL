<script id="clRqstContacts{{ucfirst($fromto)}}Template" type="text/html">
    <div style="position: relative;" class="clientrequest-{{$fromto}}-contact-wrapper mb-5 mt-5" data-i="@{{:i}}" data-n="@{{:n}}">
{{--        <input type="text" name="clientrequest[{{$fromto}}][contacts][@{{:n}}][@{{:i}}][related_id]" value="{{$model['client_request_id']}}">--}}

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">ФИО</label>
        <div class="col-lg-8">
            <input value="{{$model['fio']}}" type="text" class="form-control" name="clientrequest[{{$fromto}}][contacts][@{{:n}}][@{{:i}}][fio]">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Телефон</label>
        <div class="col-lg-8">
            <input value="{{$model['phone']}}" type="text" class="form-control phone_input" name="clientrequest[{{$fromto}}][contacts][@{{:n}}][@{{:i}}][phone]">
        </div>
    </div>

        <a href="#" class="untie-clrqst{{$fromto}}_contact-js pull-right btn btn-danger">-</a>

    </div>
</script>
