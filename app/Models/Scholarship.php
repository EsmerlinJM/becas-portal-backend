<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scholarship extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }

    public function aplication()
    {
        return $this->hasOne(Aplication::class, 'id', 'aplication_id');
    }

    public function scopeConvocatoria($query, $convocatoria_id)
    {
        if(! empty($convocatoria_id)) {

            return $query->where('convocatoria_id',"LIKE" , "%$convocatoria_id%");
        }

    }
}