<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //

    protected $primaryKey = 'id';

    protected $fillable = [
        'topic'
    ];

    public function assessment_items() {
    return $this->hasMany("App\Assessment_Item");
  	}

  	public function users() {
    return $this->hasMany("App\User_Assessment");
    }
}
