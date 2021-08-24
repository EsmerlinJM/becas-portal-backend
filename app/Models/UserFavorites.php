<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorites extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function offer()
    {
        return $this->hasOne(ConvocatoriaDetail::class, 'id', 'convocatoria_detail_id');
    }
}