<?php


namespace App\Models\Helpers;


use App\Models\Entities\ClientImagesTypes;

class ImageTypesHelper
{
    public static function getNameById($id)
    {
        return ClientImagesTypes::where('id', $id)->first()->name;
    }

    public static function getList()
    {
        return ClientImagesTypes::all();
    }
}
