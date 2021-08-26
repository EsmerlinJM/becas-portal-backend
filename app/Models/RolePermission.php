<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function permiso()
    {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }
}