<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aplication extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function convocatoria()
    {
        return $this->hasOne(Convocatoria::class, 'id', 'convocatoria_id');
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    public function convocatoria_detail()
    {
        return $this->hasOne(ConvocatoriaDetail::class, 'id', 'convocatoria_detail_id');
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'id', 'candidate_id');
    }

    public function status()
    {
        return $this->hasOne(AplicationStatus::class, 'id', 'aplication_status_id');
    }

    public function details()
    {
        return $this->hasmany(AplicationDetail::class);
    }

    public function forms()
    {
        return $this->hasmany(AplicationForm::class);
    }

    public function documents()
    {
        return $this->hasmany(Document::class);
    }
}