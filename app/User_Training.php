<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Training extends Model
{
     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function training()
    {
        return $this->belongsTo('App\Training');
    }
}
