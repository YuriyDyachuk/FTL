<div class="order_notes_buttons_block {{\App\Widgets\OrderNotes::canCoordinate($model, $userManager) || \App\Widgets\OrderNotes::canAdjust($model['status'], $model, $userManager) ? '' : 'd-none'}}">
    @if(\App\Widgets\OrderNotes::canCoordinate($model, $userManager))
        <a class="{{ isset($novalidate) ? 'novalidate' : '' }} btn btn-success save-note-btn" data-desc="{{ App\Models\Entities\OrderNotes::COORDINATION_NOTE_DESC }}">Согласование</a>
    @endif
    @if(\App\Widgets\OrderNotes::canAdjust($model['status'], $model, $userManager))
        <a class="{{ isset($novalidate) ? 'novalidate' : '' }} btn btn-warning save-note-btn" data-desc="{{ App\Models\Entities\OrderNotes::ADJUSTMENTS_NOTE_DESC }}">Корректировки</a>
    @endif
        <img width="100" src="/images/preloader.gif" alt="" class="order_notes_preloader d-none">
</div>

