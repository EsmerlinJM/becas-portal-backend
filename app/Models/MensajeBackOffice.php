<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MensajeBackOffice extends Model
{
    use HasFactory, SoftDeletes;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function candidato()
    {
        return $this->hasOne(Candidate::class, 'id', 'candidate_id');
    }
}