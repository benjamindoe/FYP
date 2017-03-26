<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttainmentTarget extends Model
{
    protected $guarded = [];

    public function attainmentGrade()
    {
    	return $this->belongsTo('App\Model\AttainmentGrade', 'grade');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Model\Subject');
    }
}
