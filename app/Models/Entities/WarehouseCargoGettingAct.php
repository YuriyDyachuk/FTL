<?php


namespace App\Models\Entities;


class WarehouseCargoGettingAct
{
    private $weight;
    private $volume;
    private $getting_act_id;

    public function __construct($weight, $volume, $getting_act_id)
    {
        $this->weight = $weight;
        $this->volume = $volume;
        $this->getting_act_id = $getting_act_id;
    }

    public function getIndex()
    {
        $weight = str_replace(' ', '', $this->weight);
        $volume = str_replace(' ', '', $this->volume);

        return $weight / $volume;
    }

    public function getGettingAct()
    {
        return GettingAct::where('id', $this->getting_act_id)->first();
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
}
