<?php

namespace App\Models\Repositories;

use App\Models\Entities\ClientRequestProducts;
use App\Models\Entities\GettingAct;
use App\Models\Entities\GettingActCargo;
use App\Models\Entities\Goods;
use App\Models\Entities\WarehouseCargo;

class WarehouseCargoRepository
{
    /**
     * @param  array  $cargo
     * @return bool
     */
    public function checkExists(array $cargo):bool
    {
        $cargoColumns = $this->getColumnsFromGettingAct($cargo);
        return WarehouseCargo::where($cargoColumns)->exists();
    }

    /**
     * @param  GettingAct  $gettingAct
     * @param $cargo
     * @return WarehouseCargo
     */
    public function create(GettingAct $gettingAct, $cargo):WarehouseCargo
    {
        //$data = array_merge(['getting_acts' => $this->updateGettingActs($gettingActId, '', $cargo)], $cargoColumns);
        $cargoColumns = $this->getColumnsFromGettingActWithAmount($cargo);
        $data = array_merge([
            'client_id' => $gettingAct->client_id,
            'provider_name' => $gettingAct->provider_name,
            'uid' => \Str::random(32),
            'getting_acts' => $this->updateGettingActs($gettingAct->id, '[]', $cargo)
        ], $cargoColumns);

        return WarehouseCargo::create($data);
    }

    /**
     * @param $cargo
     * @return WarehouseCargo
     */
    public function synchronize(GettingAct $gettingAct, $cargo):WarehouseCargo
    {
        $model = $this->findModelByColumns($cargo);
        $model->weight = $model->getWeight() + (int)str_replace(' ', '', $cargo['weight']);
        $model->volume = $model->getVolume() + (int)str_replace(' ', '', $cargo['volume']);
        $model->amount = (int)$model->amount + (int)$cargo['amount'];
        $model->getting_acts = $this->updateGettingActs($gettingAct->id, $model->getting_acts, $cargo);
        $model->save();

        return $model;
    }

    /**
     * @param  array  $cargo
     * @return array
     */
    private function getColumnsFromGettingAct(array $cargo):array
    {
        return \Arr::only($cargo, ['provider_name', 'provider_inn', 'name', 'status', 'download_type', 'pallet_size']);
    }

    private function getColumnsFromGettingActWithAmount(array $cargo):array
    {
        return \Arr::only($cargo, ['name', 'status', 'download_type', 'pallet_size', 'amount', 'weight', 'volume']);
    }

    /**
     * @param  array  $cargo
     * @return WarehouseCargo
     */
    private function findModelByColumns(array $cargo) :WarehouseCargo
    {
        $cargoColumns = $this->getColumnsFromGettingAct($cargo);

        return WarehouseCargo::where($cargoColumns)->first();
    }

    public function decrementCargoValues(int $clientRequestId, WarehouseCargo $warehouseCargo, array $cargoValues)
    {
        $warehouseCargo->weight = $warehouseCargo->getWeight() - str_replace(' ', '', $cargoValues['weight']);
        $warehouseCargo->volume = $warehouseCargo->getVolume() - str_replace(' ', '', $cargoValues['volume']);
        $warehouseCargo->amount -= $cargoValues['amount'];
        $warehouseCargo->status = GettingActCargo::IN_THE_WAREHOUSE_STATUS;
        $warehouseCargo->updateClientRequests($clientRequestId, $cargoValues);
        $warehouseCargo->save();
    }

    public function getAll()
    {
        return Goods::where('weight', '>', 0)
            ->where('volume', '>', 0)
            ->where('amount', '>', 0)
            //->whereDoesntHave('goodsLeads')
//            ->selectRaw('
//                name,
//                SUM(amount) as amount,
//                SUM(weight) as weight,
//                SUM(volume) as volume,
//                ANY_VALUE(client_id) as client_id,
//                ANY_VALUE(pallet_size) as pallet_size,
//                ANY_VALUE(download_type) as download_type,
//                ANY_VALUE(status) as status
//            ')
//            ->groupBy(['name', 'client_id', 'pallet_size', 'download_type', 'status'])
            ->sortable()
            ->get();
    }

    public function getByIds(array $goodsIds)
    {
        return Goods::whereIn('id', $goodsIds)->get();
    }

    public function getById(int $goodsId):WarehouseCargo
    {
        return Goods::where('id', $goodsId)->first();
    }

//    public function createClientRequestProductFromWarehouseCargo(int $clientRequestId, WarehouseCargo $warehouseCargo, $weight, $volume, $amount, $uid)
//    {
//        $model = ClientRequestProducts::where([
//            'client_request_id' => $clientRequestId,
//            'name' => $warehouseCargo->name
//        ])->first() ?: new ClientRequestProducts();
//
//        $model->client_request_id = $clientRequestId;
//        $model->name = $warehouseCargo->name;
//        $model->weight += str_replace(' ', '', $weight);
//        $model->volume += str_replace(' ', '', $volume);
//        $model->status = $warehouseCargo->status;
//        $model->download_type = $warehouseCargo->download_type;
//        $model->pallet_size = $warehouseCargo->pallet_size;
//        $model->amount = $amount;
//        $model->from_warehouse_cargo = true;
//        $model->uid = $uid;
//        $model->save();
//
//        return $model;
//    }

    public function getByClientId(int $client_id)
    {
        return Goods::where('weight', '>', 0)
            ->where('volume', '>', 0)
            ->where('amount', '>', 0)
            ->where('client_id', '=', $client_id)
            ->whereDoesntHave('goodsLeads')->get();
    }

//    public function getByUid($uid):WarehouseCargo
//    {
//        return WarehouseCargo::where('uid', $uid)->first();
//    }

    public function getByClientIds(?array $clientIds)
    {
        return Goods::where('weight', '>', 0)
            ->where('volume', '>', 0)
            ->where('amount', '>', 0)
            ->whereIn('client_id', $clientIds)
            ->whereDoesntHave('goodsLeads')->get();
    }


    private function findModel(int $id):Goods
    {
        return Goods::findOrFail($id);
    }

    private function updateGettingActs(int $gettingActId, ?string $getting_acts, array $cargo):string
    {
        $result = json_decode($getting_acts);

        if(!empty($result)){
            if(!in_array($gettingActId, array_column($result, 'getting_act_id'))){
                $result[] = [
                    'getting_act_id' => $gettingActId,
                    'weight' => str_replace(' ', '', $cargo['weight']),
                    'volume' => str_replace(' ', '', $cargo['volume']),
                    'amount' => str_replace(' ', '', $cargo['amount']),
                ];
            }else{
                foreach ($result as &$item) {
                    if($item->getting_act_id == $gettingActId){
                        $item->weight += str_replace(' ', '', $cargo['weight']);
                        $item->volume += str_replace(' ', '', $cargo['volume']);
                        $item->amount += str_replace(' ', '', $cargo['amount']);
                        break;
                    }
                }
            }
        }else{
            $result[] = [
                'getting_act_id' => $gettingActId,
                'weight' => str_replace(' ', '', $cargo['weight']),
                'volume' => str_replace(' ', '', $cargo['volume']),
                'amount' => str_replace(' ', '', $cargo['amount']),
            ];
        }

        return json_encode($result);
    }

    public function syncWithClientRequestProducts(array $products, int $status, ?int $clientId)
    {
        foreach ($products as $product) {
            $model = new WarehouseCargo();
            $model->weight = $product['weight'];
            $model->volume = $product['volume'];
            $model->amount = $product['amount'];
            $model->name = $product['name'];
            $model->download_type = $product['download_type'];
            $model->pallet_size = $product['pallet_size'];
            $model->status = $status;
            $model->client_request_id = $product['client_request_id'];
            $model->client_id = $clientId;
            $model->uid = $product['uid'];
            $model->save();
        }
    }
}
