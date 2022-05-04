@if(is_file('storage/images/'.$model['photofix_path']))
    <td  style="position:relative;" class="{{ $status == \App\Models\Entities\EntityStatus::DONE_STATUS ? 'bg-success' : 'bg-danger' }}">
        <a style="position:absolute;width: 100%;height: 100%;" class="table_form_link" data-fancybox="gallery"
           href="{{ Storage::url('/images/'.$model['photofix_path']) }}">+</a>
    </td>
@else
    <td style="position:relative;" class="{{ $status == \App\Models\Entities\EntityStatus::DONE_STATUS ? 'bg-warning' : 'bg-danger' }}">
        <form class="d-none add_date_photo_form" enctype="multipart/form-data" action="{{ route("$route.addphoto") }}" method="post">
            @csrf
            {{ method_field('put') }}
            <input type="hidden" name="id" value="{{ $model->id }}">
            <input type="text" name="leadId" value="{{ $leadId }}">
            <input class="add_date_photo_file_input" type="file" name="photo">
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
        <a style="position:absolute;width: 100%;height: 100%;" class="add_date_photo_link table_form_link" href="#">+</a>
    </td>
@endif
