<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluator extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function coordinator()
    {
        return $this->hasOne(Coordinator::class, 'id', 'coordinator_id');
    }

    public function institutions()
    {
        return $this->hasmany(InstitutionEvaluator::class, 'evaluator_id', 'id');
    }

    public function aplications()
    {


        return $this->hasManyThrough(
            Aplication::class ,
            InstitutionEvaluator::class,
            'institution_id', //Foreign key on the InstitutionEvaluator table...
            'institution_id', //Foreign key on the Aplication table...
            'id',
            'id'
        );

        // return $this->hasManyThrough(
        //     Deployment::class,
        //     Environment::class,
        //     'project_id', // Foreign key on the environments table...
        //     'environment_id', // Foreign key on the deployments table...
        //     'id', // Local key on the projects table...
        //     'id' // Local key on the environments table...
        // );
    }
}