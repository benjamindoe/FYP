<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'school';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * The primary key of the table
	 *
	 * @var string
	 */
	protected $primaryKey = 'unique_reference_number';

	/**
	 * Get the address of the school
	 */
	public function address()
	{
		return $this->belongsTo('App\Model\Address', 'address_id');
	}

	/**
	 * Get the staff of the school
	 */
	public function staff()
	{
		return $this->hasMany('App\Model\Staff', 'school_urn', 'unique_reference_number');
	}
}
