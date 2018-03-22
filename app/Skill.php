<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
	protected $primaryKey = 'id';

	public function user_skills()
    {
        return $this->hasMany('App\User_Skill');
    }

    public function skill_trainings()
    {
        return $this->hasMany('App\Skill_Training');
    }

}