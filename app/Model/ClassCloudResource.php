<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClassCloudResource extends Model
{
	protected $table = 'class_cloud_files';

	public function subject()
	{
		return $this->belongsTo('App\Model\Subject');
	}
	
	public function classes()
	{
		return $this->belongsTo('App\Model\Classes', 'class_id');
	}
}
