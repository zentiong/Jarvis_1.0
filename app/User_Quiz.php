<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Quiz extends Model
{
    //

    

    public function user() {
  	return $this->belongsTo("App\User",'id');
  	}

  	public function quiz() {
  	return $this->belongsTo("App\Quiz",'quiz_id');
  	}
}
