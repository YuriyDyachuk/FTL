@if(in_array($userManager->getId(), [$config['model']['responsible_user_id'],
$config['model']['responsible_chief_id'],
$config['model']['responsible_branch_chief_id'],
$config['model']['active_responsible_user_id'],
$config['model']->lead['responsible_user_id']])
|| $userManager->hasRole('admin'))
    <div class="col-sm-12 pl0">
{{--        <details class="notes-block-details" open>--}}
{{--            @if(!empty($config['fromClientRequest']))--}}
{{--                <summary>Примечания для Клиентской Заявки @include('partials.title', ['text' => App\Title::get()['clientRequest']['notes']])</summary>--}}
{{--            @else--}}
{{--                <summary>Примечания в заявке @include('partials.title', ['text' => App\Title::get()['orderForm']['notes']])</summary>--}}
{{--            @endif--}}
{{--            <div class="notes-block">--}}
{{--                <div class="notes">--}}
{{--                    @include('widgets.order-notes.order_notes_index', ['notes' => (new App\Models\Services\OrderNotesService(new App\Models\Repositories\OrderNotesRepository()))->getNotes($config['model']->id, $config['model']->getTable())])--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </details>--}}
        <div class="col-sm-12 pl0">
            @if($userManager->getId() == $config['model']['active_responsible_user_id']
             && $config['model']['status'] != \App\Models\Entities\EntityStatus::DONE_STATUS)
                <div class="savenote-form" data-action="{{route('ordernotes.savenote')}}" data-method="post">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $config['model']['id'] }}">
                    <input type="hidden" name="id" value="{{ $config['model']->id }}">
                    <input type="hidden" name="desc" class="note_desc_input">
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <textarea class="form-control message_textarea" name="text" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-2">
                            <a data-fancybox="gallery"
                               href="/images/statuses_scheme.jpg">
                                <img style="width: 150px;" class="img-responsive" src="/images/statuses_scheme.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    @if($userManager->getId() == $config['model']['active_responsible_user_id'])
                        @include('widgets.order-notes.order_notes_buttons', ['model' => $config['model'], 'userManager' => $userManager])
                    @endif
                </div>
            @endif
        </div>
    </div>
@endif
