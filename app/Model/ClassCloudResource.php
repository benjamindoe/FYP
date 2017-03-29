<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassCloudResource extends Model
{
	use SoftDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'class_cloud_files';

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	public function subject()
	{
		return $this->belongsTo('App\Model\Subject');
	}
	
	public function classes()
	{
		return $this->belongsTo('App\Model\Classes', 'class_id');
	}

	public function unopened()
	{
		return $this->hasMany('App\Model\UnopenedResource', 'resource_id');
	}
}
