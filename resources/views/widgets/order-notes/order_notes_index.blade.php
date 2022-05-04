@if(!blank($notes))
    @if(!blank($notes['user']))
        <div class="col-sm-6">
            <h5>Пользовательские примечания</h5>
            @foreach($notes['user'] as $userNote)
                <div class="message_note_block">
                    <p>
                        Дата - {{ new \Carbon\Carbon($userNote->created_at) }}
                    </p>
                    <p>
                        Тип - {{ $userNote->note_desc == App\Models\Entities\OrderNotes::COORDINATION_NOTE_DESC ? 'Согласование' : 'Корректировки' }}
                    </p>
                    <p>
                        От - {{ json_decode($userNote->text)->from }}
                    </p>
                    <p>
                        Текст: <br>
                        {{ json_decode($userNote->text)->text }} <br>
                    </p>
                </div>
            @endforeach
        </div>
    @endif
    @if(!blank($notes['system']))
        <div class="col-sm-6">
            <h5>Системные примечания</h5>
            @foreach($notes['system'] as $systemNote)
                {{ $systemNote->text }}
            @endforeach
        </div>
    @endif
@endif
