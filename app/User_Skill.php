<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Skill extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }
}
