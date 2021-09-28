<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MensajesConvocatoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'iniciada',
        'aprobada',
        'rechazada',
        'evaluacion',
        'credito',
    ];
}
