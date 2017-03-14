<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'attendance';

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'date'
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['date', 'period'];

	public function attendanceCode()
	{
		return $this->belongsTo('App\Model\AttendanceCode');
	}

	public function registrationPeriod()
	{
		return $this->belongsTo('App\Model\RegistrationPeriod');
	}
}
