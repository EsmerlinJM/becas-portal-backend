<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formulario extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function details()
    {
        return $this->hasmany(FormularioDetail::class, 'formulario_id', 'id');
    }
}
