<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationLevel extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function development_area()
    {
        return $this->hasOne(DevelopmentArea::class, 'id', 'development_area_id');
    }
}