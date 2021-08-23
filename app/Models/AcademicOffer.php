<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicOffer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function type()
    {
        return $this->hasOne(AcademicOfferType::class, 'id', 'academic_offer_type_id');
    }

    public function education_level()
    {
        return $this->hasOne(EducationLevel::class, 'id', 'education_level_id');
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    //Already defined on EducationLevel Relationship
    // public function development_area()
    // {
    //     return $this->hasOne(DevelopmentArea::class, 'id', 'development_area_id');
    // }
}