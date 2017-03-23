<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttainmentPeriod extends Model
{
	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'dob',
	];
}
