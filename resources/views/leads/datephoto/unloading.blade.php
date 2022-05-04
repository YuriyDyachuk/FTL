@if(is_file('storage/images/'.$model['unloading_date_photo']))
    <td  style="position:relative;" class="{{ $model->status == \App\Models\Entities\EntityStatus::DONE_STATUS ? 'bg-success' : 'bg-danger' }}">
        <a style="position:absolute;width: 100%;height: 100%;" class="table_form_link" data-fancybox="gallery"
           href="{{ Storage::url('/images/'.$model['unloading_date_photo']) }}">+</a>
    </td>
@else
    <td style="position:relative;" class="{{ $model->status == \App\Models\Entities\EntityStatus::DONE_STATUS ? 'bg-warning' : 'bg-danger' }}">
        <form class="d-none add_date_photo_form" enctype="multipart/form-data" action="{{ route("$route.addunloadingdatephoto") }}" method="post">
            @csrf
            {{ method_field('put') }}
            <input type="hidden" name="id" value="{{ $model->id }}">
            <input class="add_date_photo_file_input" type="file" name="photo">
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
        <a style="position:absolute;width: 100%;height: 100%;" class="add_date_photo_link table_form_link" href="#">+</a>
    </td>
@endif
