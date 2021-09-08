<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function municipality()
    {
        return $this->hasOne(Municipality::class, 'id', 'municipality_id');
    }

    public function documents()
    {
        return $this->hasmany(Document::class);
    }

    public function experienciaLaboral()
    {
        return $this->hasmany(ExperienciaLaboral::class);
    }

    public function formacionAcademica()
    {
        return $this->hasmany(FormacionAcademica::class);
    }

    public function aplications()
    {
        return $this->hasmany(Aplication::class);
    }
}