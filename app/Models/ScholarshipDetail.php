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

    public function academic_offer()
    {
        return $this->hasOne(AcademicOffer::class, 'id', 'academic_offer_id');
    }
}