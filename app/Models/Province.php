<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function municipalities()
    {
        return $this->hasmany(Municipality::class, 'province_code', 'code');
    }
}