<?php


namespace App\Models\Repositories;


use App\Models\Entities\GettingAct;

class GettingActRepository
{
    public function getAll()
    {
        return GettingAct::query()->with(['responsibleUser']);
    }

    public function createForSingleOrder(int $orderId, int $responsibleUserId)
    {
        $model = new GettingAct();
        $model->order_id = $orderId;
        $model->responsible_user_id = $responsibleUserId;

        $model->save();

        return $model;
    }

    public function create(array $data):GettingAct
    {
        $model = new GettingAct();
        $this->fillData($model, $data);
        $model->save();

        return $model;
    }

    public function update(int $id, array $data):GettingAct
    {
        $model = $this->findModel($id);
        $this->fillData($model, $data);
        $model->save();

        return $model;
    }

    public function delete(int $id)
    {
        $model = $this->findModel($id);
        $model->delete();
    }

    public function getById(int $id):GettingAct
    {
        return $this->findModel($id);
    }

    private function fillData(GettingAct $model, array $data)
    {
        $model->responsible_user_id = $data['responsible_user_id'];
        $model->date = $data['date'];
        $model->time = $data['time'];
        $model->client_id = $data['client_id'];
        $model->provider_name = $data['provider_name'];
    }

    private function findModel(int $id):GettingAct
    {
        $model = GettingAct::findOrFail($id);

        return $model;
    }

}
