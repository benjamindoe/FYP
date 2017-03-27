<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttainmentAverage extends Model
{
	protected $guarded = [];

	public function attainmentPeriod()
	{
		return $this->belongsTo('App\Model\AttainmentPeriod', 'period_id');
	}

	public function subject()
	{
		return $this->belongsTo('App\Model\Subject');
	}

	public function attainmentGrade()
	{
		return $this->belongsTo('App\Model\AttainmentGrade', 'avg_grade');
	}
}
