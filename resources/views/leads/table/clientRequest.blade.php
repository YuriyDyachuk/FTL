<tr>
    <th>Клиентские Заявки
        Пункт А / Пункт Б
        <span class="order_status_circle {{\App\Models\Entities\EntityStatus::getStatusColor(optional($lead->clientRequest)->status)}}"></span>
        @include('partials.title', ['text' => App\Title::get()['clientRequest']['statuses'], 'spanClass' => 'part_title_top'])
    </th>
    <th>Создать заявку</th>

    @if(!$lead->clientRequest()->exists())
        @if($userManager->can('client_request_edit') && $userManager->getId() == $lead->responsible_user_id || $userManager->hasRole('admin'))
            <td style="position: relative;">
                @if($userManager->getId() == $lead->responsible_user_id || $userManager->hasRole('admin'))
                <a class="{{ $lead->clients()->exists() ? '' : 'd-none' }} add_cl_request clientrequest_th_block table_form_link bg-danger clientrequest_th_block" href="{{ route('clientrequests.'.$lead->getShortLabel().'.create', ['lead' => $lead]) }}">+</a>
                @else
                    <a class="clientrequest_th_block table_form_link bg-danger clientrequest_th_block" href="#">+</a>
                @endif
            </td>
        @endif
    @else
        @foreach($period as $dt)
            @if($lead->clientRequest && $lead->clientRequest->request_date === $dt->format('d.m.Y'))
                <td style="position: relative;">
                    <a class="clientrequest_th_block clientrequest_th_block table_form_link {{ \App\Models\Entities\EntityStatus::getStatusColor($lead->clientRequest->status) }}" href="{{ route('clientrequests.'.$lead->getShortLabel().'.edit', ['client' => $lead->clientRequest]) }}">+</a>
                </td>
            @else
                <td></td>
            @endif
        @endforeach
    @endif
</tr>
