<?php

namespace App\Models\Repositories;

use App\Models\Entities\Client;

class ClientRepository
{
    public function create(array $clientRequest):Client
    {
        $model = new Client();
        $this->collectData($model, $clientRequest);
        $model->save();
        return $model;
    }

    public function update(array $clientRequest):Client
    {
        $model = Client::where('id', '=', $clientRequest['id'])->first();
        $this->collectData($model, $clientRequest);
        $model->save();
        return $model;
    }

    public function getClientsList()
    {
        return Client::where('name', '!=', '')->pluck('name', 'id')->all();
    }

    public function findByName($name)
    {
        return Client::where('name', $name)->first();
    }

    public function getAll()
    {
        return Client::all();
    }

    private function collectData(Client $model, array $clientRequest)
    {
        $model->responsible_manager_id = $clientRequest['responsible_manager_id'];
        $model->name = $clientRequest['name'];
        $model->inn = $clientRequest['inn'];
        $model->ogrn = $clientRequest['ogrn'];
        $model->leg_address = $clientRequest['leg_address'];
        $model->mail_address = $clientRequest['mail_address'];
        $model->fact_address = $clientRequest['fact_address'];
        $model->signatory = $clientRequest['signatory'];
        $model->fio = $clientRequest['fio'];
        $model->power_of_attorney = $clientRequest['power_of_attorney'];
        $model->kpp = $clientRequest['kpp'];
        $model->okpo = $clientRequest['okpo'];
        $model->bank = $clientRequest['bank'];
        $model->bik = $clientRequest['bik'];
        $model->k_account = $clientRequest['k_account'];
        $model->r_account = $clientRequest['r_account'];

        $model->regulation_1 = !empty($clientRequest['regulation_1']) && $clientRequest['regulation_1'] == 'on' ? 1 : null;
        $model->regulation_2 = !empty($clientRequest['regulation_2']) && $clientRequest['regulation_2'] == 'on' ? 1 : null;
        $model->regulation_3 = !empty($clientRequest['regulation_3']) && $clientRequest['regulation_3'] == 'on' ? 1 : null;
        $model->regulation_4 = !empty($clientRequest['regulation_4']) && $clientRequest['regulation_4'] == 'on' ? 1 : null;
        $model->regulation_5 = !empty($clientRequest['regulation_5']) && $clientRequest['regulation_5'] == 'on' ? 1 : null;

        $model->regulation_6 = !empty($clientRequest['regulation_6']) && $clientRequest['regulation_6'] == 'on' ? 1 : null;
        $model->regulation_7 = !empty($clientRequest['regulation_7']) && $clientRequest['regulation_7'] == 'on' ? 1 : null;
        $model->regulation_8 = !empty($clientRequest['regulation_8']) && $clientRequest['regulation_8'] == 'on' ? 1 : null;
        $model->regulation_9 = !empty($clientRequest['regulation_9']) && $clientRequest['regulation_9'] == 'on' ? 1 : null;
        $model->regulation_10 = !empty($clientRequest['regulation_10']) && $clientRequest['regulation_10'] == 'on' ? 1 : null;

        $model->regulation_11 = !empty($clientRequest['regulation_11']) && $clientRequest['regulation_11'] == 'on' ? 1 : null;
        $model->regulation_12 = !empty($clientRequest['regulation_12']) && $clientRequest['regulation_12'] == 'on' ? 1 : null;
        $model->regulation_13 = !empty($clientRequest['regulation_13']) && $clientRequest['regulation_13'] == 'on' ? 1 : null;
        $model->regulation_14 = !empty($clientRequest['regulation_14']) && $clientRequest['regulation_14'] == 'on' ? 1 : null;
        $model->regulation_15 = !empty($clientRequest['regulation_15']) && $clientRequest['regulation_15'] == 'on' ? 1 : null;

        $model->regulation_16 = !empty($clientRequest['regulation_16']) && $clientRequest['regulation_16'] == 'on' ? 1 : null;
        $model->regulation_17 = !empty($clientRequest['regulation_17']) && $clientRequest['regulation_17'] == 'on' ? 1 : null;
        $model->regulation_18 = !empty($clientRequest['regulation_18']) && $clientRequest['regulation_18'] == 'on' ? 1 : null;
        $model->regulation_19 = !empty($clientRequest['regulation_19']) && $clientRequest['regulation_19'] == 'on' ? 1 : null;
        $model->regulation_20 = !empty($clientRequest['regulation_20']) && $clientRequest['regulation_20'] == 'on' ? 1 : null;

        $model->regulation_21 = !empty($clientRequest['regulation_21']) && $clientRequest['regulation_21'] == 'on' ? 1 : null;
        $model->regulation_22 = !empty($clientRequest['regulation_22']) && $clientRequest['regulation_22'] == 'on' ? 1 : null;
        $model->regulation_23 = !empty($clientRequest['regulation_23']) && $clientRequest['regulation_23'] == 'on' ? 1 : null;
        $model->regulation_24 = !empty($clientRequest['regulation_24']) && $clientRequest['regulation_24'] == 'on' ? 1 : null;
    }
}
