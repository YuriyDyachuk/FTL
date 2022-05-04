@if($userManager->getId() == $model['responsible_user_id'])
    <div class="form-group">
        <a href="{{ route('trainorders.index') }}" class="btn btn-primary back_to_lead_btn">Вернуться в Заявки</a>
    </div>
    <div class="form-group">
        <a href="{{ route('tasks.tr') }}" class="btn btn-primary back_to_lead_btn">Вернуться в Задачи</a>
    </div>
@endif
<div class="form-group">
    <a href="{{ route('leads.'.$model->lead->getShortLabel().'.edit', ['lead' => $model->lead]) }}" class="btn btn-primary back_to_lead_btn">Вернуться в Сделку</a>
</div>
