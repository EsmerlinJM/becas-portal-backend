<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Exceptions\NotPermissions;
use App\Exceptions\NotBelongsTo;
use App\Tools\Tools;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }

    public function offerer()
    {
        return $this->belongsTo(Offerer::class, 'offerer_id', 'id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'id', 'user_id');
    }

    public function favoritos()
    {
        return $this->hasmany(UserFavorites::class, 'user_id', 'id');
    }

    public function notificaciones()
    {
        return $this->hasmany(Notificacion::class, 'user_id', 'id');
    }

    public function profile()
    {
        if ( auth()->user()->role->id == Tools::EVALUADOR) {
            return $this->belongsTo(Evaluator::class, 'id', 'user_id');

        } elseif ( auth()->user()->role->id == Tools::COORDINADOR) {
            return $this->belongsTo(Coordinator::class, 'id', 'user_id');

        } elseif ( auth()->user()->role->id == Tools::INSTITUCION) {
            return $this->belongsTo(Profile::class, 'id', 'user_id');

        } elseif ( auth()->user()->role->id == Tools::OFERTANTE) {
            return $this->belongsTo(Profile::class, 'id', 'user_id');

        } elseif ( auth()->user()->role->id == Tools::USUARIO) {
            return $this->belongsTo(Candidate::class, 'id', 'user_id');
        } else {
            return $this->belongsTo(Profile::class, 'id', 'user_id');
        }
    }

    //PERMISSIONS
    public function hasModule($module)
    {
        foreach (auth()->user()->role->modulos as $item) {
            if($item->modulo->name == $module) {
                return true;
            }
        }
        throw new NotPermissions;
    }

    public function hasPermission($permission)
    {
        foreach (auth()->user()->role->permisos as $item) {
            if($item->permiso->name == $permission) {
                return true;
            }
        }
        throw new NotPermissions;
    }



}