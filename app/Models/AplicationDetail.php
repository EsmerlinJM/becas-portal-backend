<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AplicationDetail extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function aplication()
    {
        return $this->belongsTo(Aplication::class, 'aplication_id', 'id');
    }

    public function requirement()
    {
        return $this->hasOne(EvaluationRequirement::class, 'id', 'evaluation_requirement_id');
    }

    public function evaluator()
    {
        return $this->hasOne(Evaluator::class, 'id', 'evaluator_id');
    }


}