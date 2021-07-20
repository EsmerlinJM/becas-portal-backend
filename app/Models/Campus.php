<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campus extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function municipality()
    {
        return $this->hasOne(Municipality::class, 'id', 'municipality_id');
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }
}