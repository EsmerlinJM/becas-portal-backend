<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function permisos(){
        return $this->hasMany(RolePermission::class);
    }

    public function modulos(){
        return $this->hasMany(RoleModulo::class);
    }
}