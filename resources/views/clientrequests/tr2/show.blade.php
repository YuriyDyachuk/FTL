<div class="col-sm-6 pl0">
    <table class="table table-striped">
        <tbody>
        <tr>
            <th><h3>Отправление</h3></th>
            <td></td>
        </tr>
        <tr>
            <th>Дата</th>
            <td>{{ $model['from_date'] }}</td>
        </tr>
        <tr>
            <th>Город</th>
            <td>{{ $model['from_city'] }}</td>
        </tr>
        <tr>
            <th><h3>Контактное лицо</h3></th>
            <td></td>
        </tr>
        <tr>
            <th>ФИО</th>
            <td>{{ $model['from_contact_name'] }}</td>
        </tr>
        <tr>
            <th>Номер</th>
            <td>{{ $model['from_contact_phone'] }}</td>
        </tr>
        <tr>
            <th><h3>Доверенность</h3></th>
            <td></td>
        </tr>
        <tr>
            <th>№-Релиз</th>
            <td>{{ $model['from_power_of_attorney_number'] }}</td>
        </tr>
        <tr>
            <th>Скан</th>
            <td>
                @if(is_file('storage/images/'.$model['from_power_of_attorney_scan']))
                    <a class="table_form_link" data-fancybox="gallery"
                       href="{{ Storage::url('/images/'.$model['from_power_of_attorney_scan']) }}">
                        <img style="width: 150px;" class="img-responsive" src="/images/document.png" alt="">
                    </a>
                @endif
            </td>
        </tr>
        <tr>
            <th><h3>Получение</h3></th>
            <td></td>
        </tr>
        <tr>
            <th>Город</th>
            <td>{{ $model['to_city'] }}</td>
        </tr>
        <tr>
            <th><h3>Контактное лицо</h3></th>
            <td></td>
        </tr>
        <tr>
            <th>ФИО</th>
            <td>{{ $model['to_contact_name'] }}</td>
        </tr>
        <tr>
            <th>Номер</th>
            <td>{{ $model['to_contact_phone'] }}</td>
        </tr>
        <tr>
            <th><h3>Доверенность</h3></th>
            <td></td>
        </tr>
        <tr>
            <th>№-Релиз</th>
            <td>{{ $model['to_power_of_attorney_number'] }}</td>
        </tr>
        <tr>
            <th>Скан</th>
            <td>
                @if(is_file('storage/images/'.$model['to_power_of_attorney_scan']))
                    <a class="table_form_link" data-fancybox="gallery"
                       href="{{ Storage::url('/images/'.$model['to_power_of_attorney_scan']) }}">
                        <img style="width: 150px;" class="img-responsive" src="/images/document.png" alt="">
                    </a>
                @endif
            </td>
        </tr>
        </tbody>
    </table>

</div>
