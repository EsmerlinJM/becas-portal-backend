<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScholarshipDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class, 'scholarship_id', 'id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

    public function aplication()
    {
        return $this->hasOne(Aplication::class, 'id', 'aplication_id');
    }

    public function convocatoria()
    {
        return $this->hasOne(Convocatoria::class, 'id', 'convocatoria_id');
    }

    public function convocatoria_detail()
    {
        return $this->hasOne(ConvocatoriaDetail::class, 'id', 'convocatoria_detail_id');
    }

    public function offerer()
    {
        return $this->hasOne(Offerer::class, 'id', 'offerer_id');
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    public function institution_offer()
    {
        return $this->hasOne(InstitutionOffer::class, 'id', 'institution_offer_id');
    }
}