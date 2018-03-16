<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Skill extends Model
{

	protected $table = 'user_skills';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
