<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property integer $id
 * @property string $name
 * @property string $weight
 * @property string $volume
 * @property string $download_type
 * @property string $pallet_size
 * @property string $amount
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 * @property string $provider_name
 * @property int $client_id
 * @property string $client_requests
 * @property string $uid
 * @property ClientRequestProducts $clientRequestProduct
 * @property int $client_request_id
 * @property ClientRequests $clientRequest
 * @property string $getting_acts
 * @mixin \Eloquent
 */
class WarehouseCargo extends Model
{
    use Sortable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warehouse_cargo';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['getting_acts', 'client_request_id', 'uid', 'client_requests', 'client_id', 'provider_name', 'status', 'name', 'weight', 'volume', 'download_type', 'pallet_size', 'amount', 'created_at', 'updated_at'];

    public function clientRequestProduct()
    {
        return $this->hasOne(ClientRequestProducts::class, 'uid', 'uid');
    }

    public function clientRequest()
    {
        return $this->belongsTo(ClientRequests::class, 'client_request_id', 'id');
    }

    public function getStatusLabel()
    {
        if(empty($this->status)){
            return null;
        }

        return GettingActCargo::statusesList()[$this->status];
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return str_replace(' ', '', $this->weight);
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return str_replace(' ', '', $this->volume);
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return str_replace(' ', '', $this->amount);
    }

    public function getIndex()
    {
        return $this->getWeight() / $this->getVolume();
    }

    public function getAmountIndex()
    {
        return $this->getWeight() / $this->getAmount();
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function updateClientRequests(int $clientRequestId, array $cargoValues)
    {
        if(!empty($this->client_requests)){
            $clientRequests = json_decode($this->client_requests);
            if(in_array($clientRequestId, array_column($cargoValues, 'id'))){
                foreach ($clientRequests as &$clientRequest) {
                    if($clientRequest['id'] == $clientRequestId){
                        $clientRequest['weight'] += $cargoValues['weight'];
                        $clientRequest['volume'] += $cargoValues['volume'];
                        $clientRequest['amount'] += $cargoValues['amount'];
                        break;
                    }
                }
            }else{
                $clientRequests[] = [
                    'id' => $clientRequestId,
                    'weight' => $cargoValues['weight'],
                    'volume' => $cargoValues['volume'],
                    'amount' => $cargoValues['amount']
                ];
            }

        }else{
            $clientRequests[] = [
                'id' => $clientRequestId,
                'weight' => $cargoValues['weight'],
                'volume' => $cargoValues['volume'],
                'amount' => $cargoValues['amount']
            ];
        }

        $this->client_requests = json_encode($clientRequests);
    }

    public function explodeByClientRequest()
    {
        $data = $this->toArray();
        $data['amount'] = str_replace(' ', '', $data['amount']);
        $data['weight'] = str_replace(' ', '', $data['weight']);
        $data['volume'] = str_replace(' ', '', $data['volume']);
        $data = [$data];
        if(!empty($data['client_requests'])){
            $newData = [];
            foreach (json_decode($data[0]['client_requests']) as $item) {
                if(in_array($item->id, array_keys($newData))){
                    $newData[$item->id]['amount'] = $this->addCargoValues($newData[$item->id]['amount'], $item->amount);
                    $newData[$item->id]['weight'] = $this->addCargoValues($newData[$item->id]['weight'], $item->weight);
                    $newData[$item->id]['volume'] = $this->addCargoValues($newData[$item->id]['volume'], $item->volume);
                    $newData[$item->id]['id'] = $item->id;
                }else{
                    $newData[$item->id] = [
                        'amount' => str_replace(' ', '', $item->amount),
                        'weight' => str_replace(' ', '', $item->weight),
                        'volume' => str_replace(' ', '', $item->volume),
                        'id' => $item->id
                    ];
                }
            }
            $data = $newData;
        }

        return $data;
    }

    private function addCargoValues($amount, $amount1)
    {
        $amount = (float)str_replace(' ', '', $amount);
        $amount1 = (float)str_replace(' ', '', $amount1);

        return $amount + $amount1;
    }

}
