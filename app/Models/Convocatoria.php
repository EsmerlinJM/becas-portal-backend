<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convocatoria extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function audience()
    {
        return $this->hasOne(Audience::class, 'id', 'audience_id');
    }

    public function type()
    {
        return $this->hasOne(ConvocatoriaType::class, 'id', 'convocatoria_type_id');
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class, 'id', 'evaluation_id');
    }

    public function formulario()
    {
        return $this->hasOne(Formulario::class, 'id', 'formulario_id');
    }

    public function details()
    {
        return $this->hasmany(ConvocatoriaDetail::class);
    }

    public function aplications()
    {
        return $this->hasmany(Aplication::class);
    }
}
