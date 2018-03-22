<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill_Training extends Model
{
    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
