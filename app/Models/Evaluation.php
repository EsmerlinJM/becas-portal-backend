<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function requirements()
    {
        return $this->hasmany(EvaluationRequirement::class, 'evaluation_id', 'id');
    }
}