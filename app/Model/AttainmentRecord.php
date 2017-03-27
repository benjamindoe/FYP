<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttainmentRecord extends Model
{
    protected $table = 'attainment_record';

    protected $guarded = [];

    public function attainmentPeriod()
    {
    	return $this->belongsTo('App\Model\AttainmentPeriod', 'period');
    }

    public function attainmentGrade()
    {
    	return $this->belongsTo('App\Model\AttainmentGrade', 'grade');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Model\Subject');
    }

    public function student()
    {
        return $this->belongsTo('App\Model\Student');
    }
}
