<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AplicationForm extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function aplication()
    {
        return $this->belongsTo(Aplication::class, 'aplication_id', 'id');
    }

    public function formulario()
    {
        return $this->hasOne(FormularioDetail::class, 'id', 'formulario_detail_id');
    }

}