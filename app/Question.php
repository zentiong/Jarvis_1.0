<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Question extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'question_item','answer_item'
    ];

    public function section() {
    return $this->belongsTo("App\Section",'id');
  }

  
}
