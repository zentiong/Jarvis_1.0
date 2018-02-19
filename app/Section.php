<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //

    protected $primaryKey = 'id';

    public function quiz() {
    return $this->belongsTo("App\Quiz",'quiz_id');
	}

	public function questions() {
    return $this->hasMany("App\Question",'section_id','id');
	}
}
