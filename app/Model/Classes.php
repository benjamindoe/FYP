<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'class';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function teachers()
	{
		return $this->belongsToMany('App\Model\Staff', 'class_teacher', 'class_id', 'staff_id');
	}

	public function students()
	{
		return $this->hasMany('App\Model\Student', 'class_id');
	}

	public function academicYear()
	{
		return $this->belongsTo('App\Model\AcademicYear', 'academic_year', 'id');
	}

}
