<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class PackingSizeCatalog extends Model
{
    protected $table = 'packing_size_catalog';
    protected $fillable = ['size'];

}
