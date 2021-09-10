<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocioEconomico extends Model
{
    use HasFactory, SoftDeletes;

    public function candidato()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
}