<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionEvaluator extends Model
{
    use HasFactory;

    public function evaluator()
    {
        return $this->hasOne(Evaluator::class, 'id', 'evaluator_id');
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    public function convocatoria()
    {
        return $this->hasOne(Convocatoria::class, 'id', 'convocatoria_id');
    }
}
