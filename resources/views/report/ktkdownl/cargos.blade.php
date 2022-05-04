@if(!empty($cargos))
    <h2>Груз:</h2>
    <form>
        <input type="hidden" name="client_request_id" value="{{ $lead->clientRequest->id }}">
        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
        @foreach ($cargos as $cargo)
            <input type="hidden" name="{{ 'export['.$cargo->id.'][uid]' }}" value="{{ $cargo->uid }}">
            @include('report.ktkdownl.cargoTable')
            @include('report.ktkdownl.exportSpoiler')
            <hr>
        @endforeach
        <a class="btn btn-success submit_add_cargo_to_container" href="#">Добавить в Контейнер</a>
    </form>
@else
    <h3>Груз не найден</h3>
@endif
