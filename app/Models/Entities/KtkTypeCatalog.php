<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class KtkTypeCatalog extends Model
{
    protected $table = 'ktk_type_catalog';
    protected $fillable = ['name'];

    public static function ktkTypes()
    {
        return ['20f', '40f'];
    }

    public static function ktkTypesWeightVolume():array
    {
        //volume - объем
        return [
            '20ft Dry Freight' => [
                'weight' => 28230,
                'volume' => 33165.55
            ],
            '20ft High Cube' => [
                'weight' => 28230,
                'volume' => 37116.9
            ],
            '20ft Open Top' => [
                'weight' => 30480,
                'volume' => 37141.79
            ],
            '40ft Dry Freight' => [
                'weight' => 26700,
                'volume' => 67617.41
            ],
            '40ft High Cube' => [
                'weight' => 26460,
                'volume' => 76207.51
            ],
            '40ft Open Top' => [
                'weight' => 26670,
                'volume' => 65217.99
            ],
            '45ft High Cube' => [
                'weight' => 27910,
                'volume' => 86022.25
            ],
            '20ft Refrigerator' => [
                'weight' => 21450,
                'volume' => 26353.31
            ],
            '40ft Refrigerator High Cube' => [
                'weight' => 26630,
                'volume' => 57380.42
            ],
        ];
    }

    public static function carTypesWeightVolume()
    {
        return [
            '20f' => [
                'weight' => 100000,
                'volume' => 50
            ],
            '40f' => [
                'weight' => 200000,
                'volume' => 50
            ],
        ];
    }
}
