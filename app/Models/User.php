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


class User extends Authenticatable
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

    public static function isAdmin()
    {
        if ( auth()->user()->role->id != Tools::ADMIN) {
            throw new NotPermissions;
        }
    }

    public static function isEvaluator()
    {
        if ( auth()->user()->role->id != Tools::EVALUADOR) {
            throw new NotPermissions;
        }
    }

    public static function isCoordinator()
    {
        if ( auth()->user()->role->id != Tools::COORDINADOR) {
            throw new NotPermissions;
        }
    }

    public static function isInstitution()
    {
        if ( auth()->user()->role->id != Tools::INSTITUCION) {
            throw new NotPermissions;
        }
    }

    public static function isOfferer()
    {
        if ( auth()->user()->role->id != Tools::OFERTANTE) {
            throw new NotPermissions;
        }
    }

    public static function isUser()
    {
        if ( auth()->user()->role->id != Tools::USUARIO) {
            throw new NotPermissions;
        }
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


}