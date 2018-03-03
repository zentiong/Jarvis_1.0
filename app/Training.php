<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    public function user_trainings()
    {
        return $this->hasMany('App\User_Training');
    }

    public function skill_trainings()
    {
        return $this->hasMany('App\Skill_Training');
    }
}
