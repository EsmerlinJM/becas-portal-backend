<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConvocatoriaDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class, 'convocatoria_id', 'id');
    }

    public function oferta()
    {
        return $this->hasOne(InstitutionOffer::class, 'id', 'institution_offer_id');
    }

    public function offerer()
    {
        return $this->hasOne(Offerer::class, 'id', 'offerer_id');
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    public function formulario()
    {
        return $this->hasOne(Formulario::class, 'id', 'formulario_id');
    }
}