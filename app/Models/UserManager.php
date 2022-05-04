<?php

namespace App\Models;

use Auth;

class UserManager
{
    private $user;
    private $roles;
    private $permissions = [];

    public function __construct()
    {
        $permissions = [];
        $this->user = Auth::getUser();
        if(!empty($this->user)) {
            $this->roles = $this->user->roles->pluck('name')->toArray();
            foreach ($this->user->roles as $role) {
                $permissions[] = $role->perms->pluck('name')->toArray();
            }
            foreach ($permissions as $permission) {
                $this->permissions += $permission;
            }
        }
    }

    public function getId()
    {
        return $this->getUser()->id;
    }

    public function getName()
    {
        return $this->getUser()->name;
    }

    public function hasRole($roleName)
    {
        return in_array($roleName, $this->getRoles());
    }

    public function can($permissionName)
    {
        return in_array($permissionName, $this->getPermissions());
    }

    public function getRoles()
    {
        return $this->roles ?: [];
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPermissions()
    {
        return $this->permissions ?: [];
    }

}
