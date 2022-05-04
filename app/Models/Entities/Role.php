<?php

namespace App\Models\Entities;

use Zizaco\Entrust\EntrustRole;

/**
 * Class Role
 * @package App\Models\Entities
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];
}
