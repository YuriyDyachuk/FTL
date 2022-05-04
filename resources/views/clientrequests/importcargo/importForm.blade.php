@if(!empty($goods))
    <h2>Груз:</h2>
    <form id="client_request_import_cargo_form">
        @foreach ($goods as $goodsItem)
            @include('clientrequests.importcargo.cargoTable')
            @include('clientrequests.importcargo.exportSpoiler')
            <hr>
        @endforeach
        <a class="btn btn-success submit_cargo_export" href="#">Добавить Груз</a>
    </form>
@else
    <h3>Груз не найден</h3>
@endif
