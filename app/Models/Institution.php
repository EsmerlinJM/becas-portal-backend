<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function type()
    {
        return $this->hasOne(InstitutionType::class, 'id', 'institution_type_id');
    }
}