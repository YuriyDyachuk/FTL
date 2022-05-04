@if($lead->client()->exists())
<h3>Клиент</h3>
@if($lead->client['name'])
    <p><b>ФИО:</b> {{ $lead->client['name'] }}</p>
@endif
@if($lead->client['inn'])
    <p><b>ИНН:</b> {{ $lead->client['inn'] }}</p>
@endif
@endif
