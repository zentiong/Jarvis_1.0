<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Quiz extends Model
{
    //

    protected $primaryKey = 'quiz_id';

    protected $fillable = [
        'topic'
    ];

    public function sections() {
    return $this->hasMany("App\Section",'id');
  	}

  	public function users() {
    return $this->hasMany("App\User_Quiz",'id');
    }
}
