<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'parent';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function students()
	{
		return $this->belongsToMany('App\Model\Student', 'student_parent', 'student_id', 'parent_id');
	}

	public function unopenedFiles()
	{
		return $this->hasMany('App\Model\UnopenedFile');
	}
}
