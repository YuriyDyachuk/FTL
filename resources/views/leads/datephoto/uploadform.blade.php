@if(is_file('storage/images/'.$photo))
    <td  style="position:relative;" class="">
        @if($userManager->can('lead_view'))
        <a class="bg-success table_form_link clientrequest_th_block" data-fancybox="gallery"
           href="{{ Storage::url('/images/'.$photo) }}">+</a>
        @else
            <a class="bg-success table_form_link clientrequest_th_block" href="#">+</a>
        @endif
    </td>
@else
    <td style="position:relative;" class="">
        <form class="d-none add_date_photo_form" enctype="multipart/form-data" action="{{ route($route) }}" method="post">
            @csrf
            {{ method_field('put') }}
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="model" value="{{ get_class($model) }}">
            <input type="hidden" name="photoField" value="{{ $photoField }}">
            <input type="hidden" name="leadId" value="{{ $leadId }}">
            <input class="add_date_photo_file_input" type="file" name="photo">
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
        <a class="{{ \App\Models\Entities\EntityStatus::getStatusColor($model['status']) }} {{$canEdit ? 'add_date_photo_link table_form_link clientrequest_th_block' : 'table_form_link clientrequest_th_block'}}" href="#">+</a>
    </td>
@endif
