<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstitutionOffer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    public function academic_offer()
    {
        return $this->hasOne(AcademicOffer::class, 'id', 'academic_offer_id');
    }

    public function campus()
    {
        return $this->hasOne(Campus::class, 'id', 'campus_id');
    }
}