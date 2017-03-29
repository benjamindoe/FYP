<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UnopenedResource extends Model
{

	protected $table = 'unopened_files';

	protected $guarded = [];

    public function file()
    {
    	return $this->belongsTo('App\Model\ClassCloudResource', 'resource_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
