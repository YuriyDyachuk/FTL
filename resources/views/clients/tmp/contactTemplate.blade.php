<script id="contactTemplate" type="text/html">
    <div style="position: relative;" class="contact-form-wrapper mt-5 col-md-6" data-i="@{{:id}}">
        <div class="row">
            <input type="hidden" name="contacts[@{{:id}}][photo]">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Фото</label>
                    <div class="col-lg-8">
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" name="contacts[@{{:id}}][photo_file]">
                            <label class="custom-file-label">Фото</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row field-contacts-@{{:id}}-name">
                    <label class="col-lg-4 col-form-label" for="contacts-@{{:id}}-name">ФИО</label>
                    <div class="col-lg-8">
                        <input class="form-control" name="contacts[@{{:id}}][name]" id="contacts-@{{:id}}-name">
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="form-group row field-contacts-@{{:id}}-position">
                    <label class="col-lg-4 col-form-label" for="contacts-@{{:id}}-position">Должность</label>
                    <div class="col-lg-8">
                        <input class="form-control" name="contacts[@{{:id}}][position]" id="contacts-@{{:id}}-position">
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="form-group row field-contacts-@{{:id}}-phone">
                    <label class="col-lg-4 col-form-label" for="contacts-@{{:id}}-phone">Телефон</label>
                    <div class="col-lg-8">
                        <input class="phone_input form-control" name="contacts[@{{:id}}][phone]" id="contacts-@{{:id}}-phone">
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="form-group row field-contacts-@{{:id}}-email">
                    <label class="col-lg-4 col-form-label" for="contacts-@{{:id}}-email">Email</label>
                    <div class="col-lg-8">
                        <input class="form-control" name="contacts[@{{:id}}][email]" id="contacts-@{{:id}}-email">
                        <div class="help-block"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <a style="position: absolute;left: 50px;bottom: -30px;" href="#" class="untie-contact-js pull-right btn btn-danger">-</a>
    </div>
</script>
