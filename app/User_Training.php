<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Training extends Model
{
	protected $table = 'user_trainings';
     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function training()
    {
        return $this->belongsTo('App\Training');
    }
}
