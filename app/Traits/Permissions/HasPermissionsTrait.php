<?php
namespace App\Traits\Permissions;
use App\Models\User\Permission;
use App\Models\User\Role;

trait HasPermissionsTrait{


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function hasPermission($permission)
    {

        foreach ($this->permissions as $userPermission){
//            return $userPermission->name == $permission->name ? true : false;
            if ($permission->name == $userPermission->name){
                return true;
            }

        }

    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if ($this->roles->contains($role)){
                return true;
            }
            return false;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRoles(...$roles)
    {
        foreach ($roles as $role)
        {
            if ($this->roles->contains('name',$role)){
                return true;
            }
        }
        return  false;
    }
}
