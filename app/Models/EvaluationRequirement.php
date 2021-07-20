<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationRequirement extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id', 'id');
    }
}